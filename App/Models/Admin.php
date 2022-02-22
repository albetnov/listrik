<?php

namespace Albet\Asmvc\Models;

use Albet\Asmvc\Core\BaseEloquent;

class Admin extends BaseEloquent
{
    protected $table = 'admin';
    public $timestamps = false;
    protected $primaryKey = 'id_admin';
    protected $fillable = ['nama_admin', 'username', 'password', 'id_level'];
    private static $cache;

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }

    public static function user()
    {
        if (!isset($_SESSION['logged'])) {
            throw new \Exception("Anda belum login bujang");
        }
        if (isset($_SESSION['type'])) {
            $result = Pelanggan::where('id_pelanggan', $_SESSION['id'])->first();
        } else {
            $result = self::with('level')->where('id_admin', $_SESSION['id'])->first();
        }
        self::$cache = $result;
        if (!self::$cache) {
            return $result;
        } else {
            return self::$cache;
        }
    }
}
