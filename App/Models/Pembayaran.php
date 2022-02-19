<?php

namespace Albet\Asmvc\Models;

use Albet\Asmvc\Core\BaseEloquent;

class Pembayaran extends BaseEloquent
{
    protected $table = 'pembayaran';
    const CREATED_AT = null;
    const UPDATED_AT = 'tanggal_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['id_tagihan', 'id_pelanggan', 'tanggal_pembayaran', 'bulan_bayar', 'biaya_admin', 'total_bayar', 'id_admin'];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
