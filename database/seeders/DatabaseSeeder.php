<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $transferUserSeeder = new TransferUserSeeder();
        $transferUserSeeder->run();

        $walletSeeder = new WalletSeeder();
        $walletSeeder->run();
    }
}
