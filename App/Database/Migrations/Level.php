<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

return new class extends BaseMigration
{
    public function up()
    {
        $this->schema->create('level', function (Blueprint $table) {
            $table->id('id_level');
            $table->string('nama_level');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('level');
    }
};
