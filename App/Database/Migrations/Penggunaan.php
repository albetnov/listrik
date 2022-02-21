<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class Penggunaan extends BaseMigration
{
    public function up()
    {
        $this->schema->create('penggunaan', function (Blueprint $table) {
            $table->id('id_penggunaan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('bulan');
            $table->year('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('penggunaan');
    }
};
