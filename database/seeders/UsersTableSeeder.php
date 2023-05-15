<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->firstName = "Susi";
        $user->lastName = "Huber";
        $user->email = "test@test.at";
        $user->password = bcrypt('secret');
        $user->image = "https://i.pinimg.com/originals/ba/d4/5a/bad45a40fa6e153ef8d1599ba875102c.png";
        $user->save();

        $user2 = new User();
        $user2->firstName = "Fritz";
        $user2->lastName = "Mair";
        $user2->email = "test2@test.at";
        $user2->password = bcrypt('secret');
        $user2->image = "https://i.pinimg.com/originals/ba/d4/5a/bad45a40fa6e153ef8d1599ba875102c.png";
        $user2->save();


    }
}
