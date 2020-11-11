<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
                'title' => 'tiêu đề bài viết 1',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'select_img.png',
                'active' => 0,
                'slug' =>Str::slug('tiêu đề bài viết 1'),
                'created_at' => new DateTime()
            ],
            [
                'title' => 'tiêu đề bài viết 2',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'select_img.png',
                'active' => 1,
                'slug' =>Str::slug('tiêu đề bài viết 2'),
                'created_at' => new DateTime()
            ],
            [
                'title' => 'tiêu đề bài viết 3',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'select_img.png',
                'active' => 1,
                'slug' =>Str::slug('tiêu đề bài viết 3'),
                'created_at' => new DateTime()
            ],
            [
                'title' => 'tiêu đề bài viết 4',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'select_img.png',
                'active' => 1,
                'slug' =>Str::slug('tiêu đề bài viết 4'),
                'created_at' => new DateTime()
            ],
            [
                'title' => 'tiêu đề bài viết 5',
                'content' => 'Lorem ipsum dolor sit amet consectetur 
                adipisicing elit. Pariatur expedita distinctio quaerat 
                ullam blanditiis hic sint in, rerum incidunt, dolor quasi 
                necessitatibus. Sed consequuntur id minus velit veniam, quas error?',
                'img' =>'select_img.png',
                'active' => 1,
                'slug' =>Str::slug('tiêu đề bài viết 5'),
                'created_at' => new DateTime()
            ]
        ]
        );
    }
}
