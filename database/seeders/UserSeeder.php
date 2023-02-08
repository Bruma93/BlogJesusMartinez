<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comentario;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create()->each(function($u){
            $u->posts()->saveMany(Post::factory(1)->make());
            $u->comentarios()->saveMany(Comentario::factory(1)->make());
            
        });
    }
}
