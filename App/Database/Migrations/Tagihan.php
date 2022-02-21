<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class Tagihan extends BaseMigration
{
    public function up()
    {
        $this->schema->create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->foreignId('id_penggunaan')->constrained('penggunaan', 'id_penggunaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('bulan');
            $table->year('tahun');
            $table->string('jumlah_meter');
            $table->string('status');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('tagihan');
    }
};
