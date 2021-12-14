<?php

namespace App\Http\Controllers;

use App\Services\CreateTransferService;
use App\Services\ServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransferController extends Controller
{

    /**
     * Create a transfer between users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request, CreateTransferService $createTransferService)
    {
        try {
            $createTransferService->run($request->all());
            return response()->json([
                "message" => "success"
            ], Response::HTTP_CREATED);
        } catch (Exception $err) {
            return response()->json([
                'errors' => empty(json_decode($err->getMessage())) ? $err->getMessage() : json_decode($err->getMessage())
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
