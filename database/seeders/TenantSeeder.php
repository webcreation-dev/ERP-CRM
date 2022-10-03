<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tenants")->insert ([
            [
                "name" => "tenant2",
                "email" => "tenant2@gmail.com",
                "database" => "tenant2",
            ],
        ]);
    }
}
