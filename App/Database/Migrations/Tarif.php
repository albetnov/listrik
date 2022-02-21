<?php

namespace Albet\Asmvc\Database\Migrations;

use Albet\Asmvc\Core\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class Tarif extends BaseMigration
{
    public function up()
    {
        $this->schema->create('tarif', function (Blueprint $table) {
            $table->id('id_tarif');
            $table->integer('daya');
            $table->integer('tarifperkwh');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('tarif');
    }
};
