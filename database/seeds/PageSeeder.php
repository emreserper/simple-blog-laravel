<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['ABOUT', 'VISION', 'MISSION'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'image' => 'https://assets.entrepreneur.com/content/3x2/2000/20160602195129-businessman-writing-planning-working-strategy-office-focus-formal-workplace-message.jpeg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam autem commodi distinctio dolor dolore earum enim ipsa ipsum iusto molestias nulla odit officiis, omnis perspiciatis ratione sapiente unde vitae voluptates.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam autem commodi distinctio dolor dolore earum enim ipsa ipsum iusto molestias nulla odit officiis, omnis perspiciatis ratione sapiente unde vitae voluptates.',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
