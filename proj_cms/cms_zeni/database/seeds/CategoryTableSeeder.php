<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
        [
            [
                'name' => "Thể thao",
                'slug' => 'the-thao',
                'created_at' => new DateTime()
            ],
            [
                'name' => "Ẩm thực",
                'slug' => 'am-thuc',
                'created_at' => new DateTime()
            ],
            [
                'name' => "Du lịch",
                'slug' => 'du-lich',
                'created_at' => new DateTime()
            ]
        ]
        );
    }
}
