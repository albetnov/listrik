<?php

namespace Albet\Asmvc\Models;

use Albet\Asmvc\Core\BaseEloquent;

class Pelanggan extends BaseEloquent
{
    protected $table = 'pelanggan';
    public $timestamps = false;
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['username', 'password', 'no_kwh', 'nama_pelanggan', 'alamat', 'id_tarif'];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }
}
