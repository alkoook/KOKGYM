<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // 👈 أضف هذا السطر

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class
        ]);
        User::factory()->create([
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'password'=>Hash::make('123456'),
            'birth_date'=>'2000/6/14',
            'phone'=>'0956571037',
            'birth_date'=> '2000-06-14'
        ])->assignRole('admin');
        Exercise::create([
            'name'=>'راحة',
            'video'=>'oK',
            'description'=>'اليوم لا يمكنك لعب أية تمارين مقاومة أو كارديو',
            'category'=>'راحة',
            'level'=>'advanced',
        ]);
         $machines = [
            ['name' => 'Chest Press',        'origin_country' => 'USA',       'price' => 1200, 'image' => null],
            ['name' => 'Leg Press',          'origin_country' => 'Germany',   'price' => 1800, 'image' => null],
            ['name' => 'Lat Pulldown',       'origin_country' => 'Italy',     'price' => 1500, 'image' => null],
            ['name' => 'Treadmill',          'origin_country' => 'China',     'price' => 2200, 'image' => null],
            ['name' => 'Elliptical',         'origin_country' => 'France',    'price' => 2000, 'image' => null],
            ['name' => 'Rowing Machine',     'origin_country' => 'USA',       'price' => 1700, 'image' => null],
            ['name' => 'Cable Crossover',    'origin_country' => 'Turkey',    'price' => 1300, 'image' => null],
            ['name' => 'Smith Machine',      'origin_country' => 'Germany',   'price' => 2500, 'image' => null],
            ['name' => 'Spin Bike',          'origin_country' => 'China',     'price' => 900,  'image' => null],
            ['name' => 'Abdominal Crunch',   'origin_country' => 'Italy',     'price' => 800,  'image' => null],
        ];
                foreach ($machines as $m) {
            DB::table('machines')->insert([
                'name' => $m['name'],
                'origin_country' => $m['origin_country'],
                'price' => $m['price'],
                'image' => $m['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
                $member_ships = [
            ['name' => 'الاشتراك الشهري',       'duration_days' => 30,  'price' => 35,  'is_active' => true],
            ['name' => 'الاشتراك ربع السنوي',   'duration_days' => 90,  'price' => 90,  'is_active' => true],
            ['name' => 'الاشتراك السنوي',       'duration_days' => 365, 'price' => 300, 'is_active' => true],
            ['name' => 'باقة VIP الذهبية',      'duration_days' => 30,  'price' => 80,  'is_active' => true],
            ['name' => 'باقة المبتدئين',         'duration_days' => 30,  'price' => 20,  'is_active' => true],
        ];

        foreach ($member_ships as $p) {
            DB::table('memberships')->insert([
                'name' => $p['name'],
                'duration_days' => $p['duration_days'],
                'price' => $p['price'],
                'is_active' => $p['is_active'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }
}