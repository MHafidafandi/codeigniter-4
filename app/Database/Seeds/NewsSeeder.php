<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run()
    {

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 50; $i++) {
            $data = [
                'News' => $faker->paragraph()
            ];
            // Using Query Builder
            $this->db->table('News')->insert($data);
        }
        // Simple Queries
        // $this->db->query('INSERT INTO news (News) VALUES(:News:)', $data);

    }
}
