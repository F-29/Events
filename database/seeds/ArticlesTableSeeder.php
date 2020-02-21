<?php

use App\Article;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Article::truncate();
        $this->seedArticles();
    }

    /**
     * Seeds the Article table.
     *
     * @return void
     * @throws Exception
     */
    private function seedArticles()
    {
        $faker = Factory::create();
        for ($i=1; $i<6; $i++) {
            foreach (range(1, random_int(1, 4)) as $j) {
                Article::create([
                    'user_id' => $i,
                    'title' => 'article' . $i . ' ' . $faker->text(23),
                    'body' => $faker->realText(),
                ]);
            }
        }
    }
}
