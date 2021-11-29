<?php 

namespace App\Repositories;

use App\Models\TransferUser;
use App\Repositories\Traits\Find;

final class TransferUserRepository extends BaseRepository
{

    use Find;
    /**
     * create a isntance of TransferUser for entity
     *
     */
    public function __construct()
    {
        parent::__construct(new TransferUser());
    }

}
