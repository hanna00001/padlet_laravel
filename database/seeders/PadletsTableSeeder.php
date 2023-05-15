<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Entrie;
use App\Models\Padlet;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;


class PadletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $padlet = new Padlet();
        $padlet->name = "Mein erstes Padlet";
        $padlet->user_id = "1";
        $padlet->is_public = true;
        $padlet->save();

        $padlet2 = new Padlet();
        $padlet2->name = "Mein zweites Padlet";
        $padlet2->user_id = "1";
        $padlet2->is_public = true;
        $padlet2->save();

        $entrie = new Entrie();
        $entrie->user_id = '1';
        $entrie->padlet_id = '1';
        $entrie->title = 'Ein neuer Entrie';
        $entrie->content = 'Das ist der Content vom Entrie balfkadfjjaksdfbkjsadjk';
        $entrie->save();

        $entrie1 = new Entrie();
        $entrie1->user_id = '1';
        $entrie1->padlet_id = '1';
        $entrie1->title = 'Ein zweiter neuer Entrie';
        $entrie1->content = 'Das ist der Content vom Entrie balfkadfjjaksdfbkjsadjk';
        $entrie1->save();

        $padlet->entries()->saveMany([$entrie, $entrie1]);
        $padlet->save();

        $comment1 = new Comment();
        $comment1->user_id = 1;
        $comment1->entrie_id = 1;
        $comment1->comment = 'Ein lustiges erstes Kommentar';
        $comment1->save();

        $rating1 = new Rating();
        $rating1->user_id = 1;
        $rating1->entrie_id = 1;
        $rating1->rating = 4;
        $rating1->save();

        $entrie->comments()->saveMany([$comment1]);
        $entrie->ratings()->saveMany([$rating1]);
        $entrie->save();
    }
}
