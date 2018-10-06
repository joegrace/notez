<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Note;
use App\Tag;
use App\User;

class FakeNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get this user
        $user = User::find(1);

        for($i = 0; $i <= 20; $i++) {
            $note = new Note();
            $note->user()->associate($user);
            $note->title = $faker->word;
            $note->note = '<p>' . $faker->paragraph . '</p>';

            // A couple of tags
            $tag1 = new Tag();
            $tag1->text = $faker->word;
            $tag1->save();

            $tag2 = new Tag();
            $tag2->text = $faker->word;
            $tag2->save();

            $note->save();
            $note->tags()->sync([$tag1->id, $tag2->id]);
        }
    }
}
