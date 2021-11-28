<?php

namespace Database\Seeders;

use App\Models\TransferUser;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transferUser = new TransferUser();
        $users = $transferUser->where('document_type',TransferUser::DOCUMENT_TYPE_CPF)->get();
        foreach($users as $user) {
            Wallet::query()->create([
                'transfer_user_id' => $user->id,
                'balance' => 1000.00
            ]);
        }
    }
}
