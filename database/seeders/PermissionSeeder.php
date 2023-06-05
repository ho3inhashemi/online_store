<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    //all route names are considers as permissions
    private $permissions = [
        'test'
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [];
        foreach($this->permissions as $permission)
        {
            $array[] = [
                'name' => $permission
            ];
        }

        Permission::insert($array);
    }
}
