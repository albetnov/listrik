<?php

namespace Albet\Asmvc\Database\Seeders;

use Albet\Asmvc\Core\Seeders;

class LevelSeeder extends Seeders
{
    public function run()
    {
        /**
         * @param int $count
         * @param string|callable $table
         * @param array $data
         * count() method is optional.
         */
        $this->seed('level', [
            [
                'nama_level' => 'admin'
            ],
            [
                'nama_level' => 'pelanggan'
            ],
            [
                'nama_level' => 'bank'
            ]
        ]);
    }
}
