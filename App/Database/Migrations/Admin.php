<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class Admin extends BaseMigration
{
    public function up()
    {
        $this->schema->create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama_admin');
            $table->string('username');
            $table->string('password');
            $table->foreignId('id_level')->constrained('level', 'id_level')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('admin');
    }
};
