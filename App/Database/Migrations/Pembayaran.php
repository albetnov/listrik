<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class Pembayaran extends BaseMigration
{
    public function up()
    {
        $this->schema->create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran');
            $table->foreignId('id_tagihan')->constrained('tagihan', 'id_tagihan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('tanggal_pembayaran');
            $table->string('bulan_bayar');
            $table->integer('biaya_admin');
            $table->integer('total_bayar');
            $table->foreignId('id_admin')->constrained('admin', 'id_admin')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('pembayaran');
    }
};
