<?php

namespace Albet\Asmvc\Database\Seeders;

use Albet\Asmvc\Core\Seeders;

class UserSeeder extends Seeders
{
    public function run()
    {
        /**
         * @param int $count
         * @param string|callable $table
         * @param array $data
         * count() method is optional.
         */
        $this->count(1)->seed('admin', [
            'username' => 'root',
            'password' => mkPass(PASSWORD_BCRYPT, 'root12345'),
            'id_level' => '1',
            'nama_admin' => 'SuperAdmin'
        ]);
    }
}
