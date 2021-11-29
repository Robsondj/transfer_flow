<?php 

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

final class AuthorizeTransactionService implements InterfaceService
{

    const AUTHORIZE_MESSAGE = "Autorizado";

    public static function run($data = []): bool
    {
        $response = Http::get(env("AUTHORIZE_TRANSFER_URL"));
        if($response->status() !== Response::HTTP_OK
           || Arr::get($response->json(), 'message') !== self::AUTHORIZE_MESSAGE) {
            return false;
        }
        return true;
    }
}