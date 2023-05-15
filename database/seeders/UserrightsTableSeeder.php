<?php

namespace Database\Seeders;

use App\Models\Userright;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserrightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userrights = new Userright();
        $userrights->user_id = 1;
        $userrights->padlet_id = 1;
        $userrights->read = true;
        $userrights->edit = true;
        $userrights->delete = true;
        $userrights->save();

        $userrights2 = new Userright();
        $userrights2->user_id = 2;
        $userrights2->padlet_id = 1;
        $userrights2->read = true;
        $userrights2->edit = true;
        $userrights2->delete = true;
        $userrights2->save();
    }
}
