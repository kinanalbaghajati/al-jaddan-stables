<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         $user = User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'SuperAdmin@email.com',
             'image' => 'backend_theme/static_images/user.png',
             'password' => Hash::make('password'), // password
             ]);

         $role = Role::create([
             'name'=>'Super',
             'guard_name'=>'web',
             'created_at'=>Carbon::now(),
         ]);


        $permissions = ['admin_tab', 'roles_tab', 'horses', 'create_horse', 'main_title', 'first_section', 'second_section', 'gallery','contact_us'];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
        $role->syncPermissions($permissions);
        $user->assignRole($role->name);


        $numberNames = ['first', 'second', 'third','title'];
        for ($i = 0; $i < 4; $i++) {
            DB::table('contents')->insert([
                'name' => $numberNames[$i],
                'text' => json_encode([
                    'en' => '',
                    'ar' => '',
                ]),
            ]);


        }
        DB::table('galleries')->insert([
            'name' => 'first',
        ]);
    }
}
