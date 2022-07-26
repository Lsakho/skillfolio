<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'login' => 'lsakho', 
            'email' => 'sakho.lamine2k19@gmail.com',
            'password' => bcrypt('123456')
        ]);
      
        $role = Role::create(['name' => 'Admin']);
       
        $permissions = Permission::create(['name' => 'Admin']);
     
        $role->syncPermissions($permissions);
        
       
        $user->assignRole([$role->id]);
    }
}