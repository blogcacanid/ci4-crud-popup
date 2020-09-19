<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class Pegawai extends Migration {

    public function up() {
        $this->forge->addField([
            'pegawai_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nip' => [
                'type' => 'CHAR',
                'constraint' => 15,
                'null' => FALSE
            ],
            'nama_pegawai' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => FALSE,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('pegawai_id', TRUE);
        $this->forge->createTable('pegawai');
    }

    //--------------------------------------------------------------------

    public function down() {
        $this->forge->dropTable('pegawai');
    }

}
