<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class Pelanggan extends BaseMigration
{
    public function up()
    {
        $this->schema->create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('username');
            $table->string('password');
            $table->integer('nokwh');
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->foreignId('id_tarif')->constrained('tarif', 'id_tarif')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('pelanggan');
    }
};
