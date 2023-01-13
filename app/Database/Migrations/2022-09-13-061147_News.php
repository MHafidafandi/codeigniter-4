<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\MySQLi\Forge;

class News extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'News_id' => [
                'type'              => 'INT',
                'Constraint'        => 9,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'News' => [
                'type'              => 'VARCHAR',
                'Constraint'        => 255,
            ]
        ]);

        $this->forge->addKey('News_id', TRUE);
        $this->forge->createTable('News');
    }

    public function down()
    {
        $this->forge->dropTable('News');
    }
}
