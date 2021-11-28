<?php

namespace Database\Seeders;

use Database\Factories\TransferUserCpfFactory;
use Database\Factories\TransferUserCnpjFactory;
use Illuminate\Database\Seeder;

class TransferUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransferUserCpfFactory::new()->count(5)->create();
        TransferUserCnpjFactory::new()->count(5)->create();
    }
}
