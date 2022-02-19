<?php

namespace Albet\Asmvc\Models;

use Albet\Asmvc\Core\BaseEloquent;

class Tarif extends BaseEloquent
{
    protected $table = 'tarif';
    public $timestamps = false;
    protected $primaryKey = 'id_tarif';
    protected $fillable = ['daya', 'tarifperkwh'];
}
