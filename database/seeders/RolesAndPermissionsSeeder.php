<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // مسح كل شيء قبل التشغيل لتجنب التكرار
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // إنشاء الصلاحيات
        $permissions = [
            'manage users',      // إدارة المستخدمين (Admin)
            'manage subscriptions', // إدارة الاشتراكات
            'manage payments',      // إدارة المدفوعات
            'manage attendance',    // متابعة الحضور
            'manage supplements',    //  إدارة المكملات
            'manage machines',    // إدارة المكنات
            'manage exercises',    // إدارة التمارين
            'manage programs',    // إدارة المخزن
            'manage memberships',

            'view my program',         // الاطلاع على تماريني
            'view my payments',         //  الاطلاع على دفعاتي
            'view machines',         // الاطلاع على المكنات
            'view supplements',         // الاطلاع على المكملات
            'view reports',         // الاطلاع على التقارير
            'view my reports',         // الاطلاع على تقاريري
            'view my subscription',         // الاطلاع على اشتراكي
            'view my attendance',         // الاطلاع على حضوري
            'self check in'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // إنشاء الأدوار
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $trainer = Role::firstOrCreate(['name' => 'trainer']);
        $member = Role::firstOrCreate(['name' => 'member']);

        // ربط الصلاحيات بالأدوار
        $admin->givePermissionTo(Permission::all()); // الأدمن عنده كل الصلاحيات

            $trainer->givePermissionTo([
            'manage supplements',
            'manage machines',
            'manage exercises',
            'manage attendance',
            'view reports',
            'manage programs'

        ]);

        $member->givePermissionTo([
            'view my program',
            'view my payments',
            'view machines',
            'view supplements',
            'view my reports',
            'view my subscription',
            'view my attendance',
            'self check in'
        ]);


        $this->command->info('Roles and permissions seeded successfully!');
    }
}
