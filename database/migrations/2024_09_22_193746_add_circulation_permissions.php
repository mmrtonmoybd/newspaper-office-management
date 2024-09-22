<?php

use Illuminate\Database\Migrations\Migration;

class AddCirculationPermissions extends Migration
{
    private $permissions = [
        [
            'name' => 'monthly_circulation',
            'display_name' => 'Monthly circulation',
            'description' => 'Monthly circulation permission of circulation management section.',
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
            'name' => 'circulation',
            'display_name' => 'Circulation',
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

        DB::table('permissions_categories')->where('name', 'circulation')->delete();
    }
}
