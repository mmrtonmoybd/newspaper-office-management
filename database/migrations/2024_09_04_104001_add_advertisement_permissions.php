<?php

use Illuminate\Database\Migrations\Migration;

class AddAdvertisementPermissions extends Migration
{
    private $permissions = [
        [
            'name'         => 'as_permission',
            'display_name' => 'A/S advertisement',
            'description'  => 'A/S advertisement permission of Advertisement section.',
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
            'name'         => 'advertisement',
            'display_name' => 'Advertisement',
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

        DB::table('permissions_categories')->where('name', 'advertisement')->delete();
    }
}
