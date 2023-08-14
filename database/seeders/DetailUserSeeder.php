<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ManagementAccess\DetailUser;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_user = [
            [
                'user_id'        => 1,
                'type_user_id'   => 1,
                'job_position'   => 2,
                'status'         => 1,
                'created_at'     => '2022-04-22 00:00:00',
                'updated_at'     => '2022-04-22 00:00:00',
            ],
        ];

        DetailUser::insert($detail_user);
    }
}
