<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\DumpCommand;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 200; $i++) {
            //estraggo un post random
            $post = Post::inRandomOrder()->first();
            //dump($post);

            //AI FINI DELLA RELAZIONE SERVE AVERE DA UN LATO UN ENTITA' E
            //DALL'ALTRO LATO L'ID DELL'ENTITA'
            //PERCHE' SI UTILIZZA IL METODO attach()
            //estraggo id di un tag random
            $tag_id = Tag::inRandomOrder()->first()->id;

            //Aggiungo la relazione fra il post estratto e l'id del tag estratto
            $post->tags()->attach($tag_id);
        }
    }
}
