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
        DB::table('posts')->insert(
        [
            [
                'title' => 'Chùa Nam Sơn - Đà Nẵng',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'i1',
                'active' => 0,
                'slug' =>'chua-nam-son-da-nang',
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Chùa Nam Sơn - Đà Nẵng 3',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'i2',
                'active' => 0,
                'slug' =>'chua-nam-son-da-nang-3',
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Chùa Nam Sơn - Đà Nẵng 4',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'i3',
                'active' => 0,
                'slug' =>'chua-nam-son-da-nang-4',
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Chùa Nam Sơn - Đà Nẵng 2',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'i4',
                'active' => 0,
                'slug' =>'chua-nam-son-da-nang-2',
                'created_at' => new DateTime()
            ]
        ]
        );
    }
}
