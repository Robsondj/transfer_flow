<?php 

namespace App\Http\Controllers;

use App\Services\CreateTransferService;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    /**
     * Create a transfer between users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {

        CreateTransferService::run([]);
    }
}
