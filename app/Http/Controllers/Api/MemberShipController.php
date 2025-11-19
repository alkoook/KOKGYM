<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        
        return response()->json(['data' => $memberships], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255|unique:memberships,name',
            'duration_days' => 'required|integer|min:1',
            'price'         => 'required|numeric|min:0.01',
            'is_active'     => 'sometimes|boolean'
        ]);
        
        $membership = Membership::create($validated);
        
        return response()->json([
            'message' => 'Membership plan created successfully',
            'data'    => $membership
        ], 201);
    }

    public function show(string $id)
    {
        $membership = Membership::findOrFail($id);
        
        return response()->json(['data' => $membership], 200);
    }

    public function update(Request $request, string $id)
    {
        $membership = Membership::findOrFail($id);

        $validated = $request->validate([
            // نستخدم قاعدة 'ignore' لتجاهل التكرار في الاسم إذا كان الاسم الحالي هو نفسه
            'name'          => 'sometimes|string|max:255|unique:memberships,name,' . $id,
            'duration_days' => 'sometimes|integer|min:1',
            'price'         => 'sometimes|numeric|min:0.01',
            'is_active'     => 'sometimes|boolean'
        ]);
        
        $membership->update($validated);

        return response()->json([
            'message' => 'Membership plan updated successfully',
            'data'    => $membership
        ], 200);
    }

    public function destroy(string $id)
    {
        $membership = Membership::findOrFail($id);
        
        $membership->delete();

        // كود الحالة 204 هو المعيار الصحيح لعملية حذف ناجحة بدون محتوى للرد
        return response()->json(null, 204);
    }
}