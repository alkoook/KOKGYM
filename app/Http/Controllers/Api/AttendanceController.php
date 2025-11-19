<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Subscription;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // عرض كل سجلات الحضور للإداري فقط
    public function index()
    {
        if(!auth()->user()->hasRole('admin')){
            return response()->json(['message' => 'You Dont Have Permission To Do That'], 403);
        }
        $attendances = Attendance::with('member')->get();

        return response()->json(['data' => $attendances], 200);
    }

    // دالة واحدة وموحدة للدخول والخروج (تعتمد على user_id و uid)
    public function checkInOut(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'uid'     => 'required|string', 
        ]);

        $user = User::findOrFail($validated['user_id']);

        if ($user->uid !== $validated['uid']) {
            return response()->json(['message' => 'عذراً البصمة/الرمز غير متطابق'], 403);
        }
        
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::today())
            ->where('is_active', 1) 
            ->first();

        if (!$activeSubscription) {
            return response()->json(['message' => 'عذراً انتهى اشتراكك بالفعل أو غير مفعّل'], 403);
        }

        $lastCheckIn = Attendance::where('user_id', $user->id)
            ->whereNull('check_out_time')
            ->latest('check_in_time')
            ->first();

        if ($lastCheckIn) {
            $lastCheckIn->update([
                'check_out_time' => Carbon::now(),
                'status' => 'Checked Out'
            ]);

            return response()->json([
                'message' => "تم تسجيل الخروج بنجاح. وقت الخروج: " . $lastCheckIn->check_out_time,
                'data' => $lastCheckIn
            ], 200);

        } else {
            $attendance = Attendance::create([
                'user_id'         => $user->id,
                'subscription_id' => $activeSubscription->id,
                'check_in_time'   => Carbon::now(),
                'status'          => 'Checked In',
            ]);

            return response()->json([
                'message' => "تم تسجيل الدخول بنجاح. اشتراك ساري المفعول.",
                'data' => $attendance
            ], 201);
        }
    }

    
    public function show(string $id)
    {
        $user = User::findOrFail($id);        
        $attendances = Attendance::where('user_id', $user->id)->get();
        
        return response()->json(['data' => $attendances], 200);
    }

    public function myAttendance()
    {
        $userId = auth()->id();
        $myAttendances = Attendance::where('user_id', $userId)->get();
        
        return response()->json(['data' => $myAttendances], 200);
    }
    
    public function trainerAttendances()
    {
        $user = auth()->user();

        if (!$user->hasRole('trainer') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        if (method_exists($user, 'members')) {
            $memberIds = $user->members()->pluck('id');
        } else {
             $memberIds = User::whereHas('roles', function($query){
                 $query->where('name', 'member');
             })->pluck('id');
        }
        
        $attendances = Attendance::whereIn('user_id', $memberIds)->get();

        return response()->json(['data' => $attendances], 200);
    }
    
    public function current()
    {
        if(!auth()->user()->hasRole('admin')){
            return response()->json(['message' => 'You Dont Have Permission To Do That'], 403);
        }
        $attendances = Attendance::with('member')
            ->whereNull('check_out_time')
            ->get();

        return response()->json([
            'count' => $attendances->count(),
            'data' => $attendances->map(function($attendance){
                return [
                    'id' => $attendance->id,
                    'member_id' => $attendance->user_id,
                    'member_name' => $attendance->member->name,
                    'check_in' => $attendance->check_in_time,
                ];
            }),
        ], 200);
    }
}