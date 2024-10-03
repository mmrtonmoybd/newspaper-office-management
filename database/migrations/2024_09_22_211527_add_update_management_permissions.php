<?php

use Illuminate\Database\Migrations\Migration;

class AddUpdateManagementPermissions extends Migration
{
    private $permissions = [
        [
            'name'         => 'update_an',
            'display_name' => 'Update A/N',
            'description'  => 'Update A/N',
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $catId = DB::table('permissions_categories')->insertGetId([
            'name'         => 'update_management',
            'display_name' => 'Update management',
        ]);

        foreach ($this->permissions as $permission) {
            $permission['created_at'] = date('Y-m-d H:i:s');
            $permission['updated_at'] = date('Y-m-d H:i:s');
            $permission['category_id'] = $catId;
            DB::table('permissions')->insert($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->permissions as $permission) {
            DB::table('permissions')->where('name', $permission['name'])->delete();
        }

        DB::table('permissions_categories')->where('name', 'update_management')->delete();
    }
}
