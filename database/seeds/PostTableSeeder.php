<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
   {
   	$posts = factory(Nht\Hocs\Posts\Post::class, 3000)->create();
   }
}
