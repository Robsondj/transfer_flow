<?php 

namespace App\Repositories;

use App\Models\Transfer;
use App\Models\TransferUser;
use App\Models\Wallet;
use App\Repositories\Traits\Find;
use Ramsey\Uuid\Uuid;

final class TransferRepository extends BaseRepository
{

    use Find;
    /**
     * create a isntance of TransferUser for entiry
     *
     */
    public function __construct()
    {
        parent::__construct(new Transfer());
    }

    /**
     * Save a transaction between two users
     *
     * @param TransferUser $payer
     * @param TransferUser $payee
     * @param [type] $value
     * @return void
     */
    public function transfer(TransferUser $payer, TransferUser $payee, float $value)
    {
        $transfer = Transfer::create([
            'id' => (string) Uuid::uuid4(),
            'payer' => $payer->id,
            'payee' => $payee->id,
            'value' => $value
        ]);
        $this->addBalanceWallet($payee->id, $value);
        $this->subtractBalanceWallet($payer->id, $value);
        return $transfer;
    }

    /**
     * Add value to wallet
     *
     * @param integer $walletId
     * @param float $value
     * @return void
     */
    private function addBalanceWallet(int $walletId, float $value)
    {
        $wallet = Wallet::find($walletId);
        $wallet->balance += $value;
        $wallet->save();
    }
    
    /**
     * Subtract value to wallet
     *
     * @param integer $walletId
     * @param float $value
     * @return void
     */
    private function subtractBalanceWallet(int $walletId, float $value)
    {
        $wallet = Wallet::find($walletId);
        $wallet->balance -= $value;
        $wallet->save();
    }
}
