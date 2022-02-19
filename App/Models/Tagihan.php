<?php

namespace Albet\Asmvc\Models;

use Albet\Asmvc\Core\BaseEloquent;

class Tagihan extends BaseEloquent
{
    protected $table = 'tagihan';
    public $timestamps = false;
    protected $primaryKey = 'id_tagihan';
    protected $fillable = ['id_penggunaan', 'id_pelanggan', 'bulan', 'tahun', 'jumlah_meter', 'status'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function penggunaan()
    {
        return $this->belongsTo(Pengunaan::class, 'id_penggunaan');
    }
}
