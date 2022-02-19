<?php

namespace Albet\Asmvc\Models;

use Albet\Asmvc\Core\BaseEloquent;

class Pengunaan extends BaseEloquent
{
    protected $table = 'penggunaan';
    protected $primaryKey = 'id_penggunaan';
    public $timestamps = false;
    protected $fillable = ['id_pelanggan', 'bulan', 'tahun', 'meter_awal', 'meter_akhir'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
