<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

final class SendEmailConfirmationService implements ServiceInterface
{

    const EMAIL_MESSAGE = "Success";

    /**
     * Send email about transfer to payee
     *
     * @param array $data
     * @return boolean
     */
    static public function run($data): bool
    {
        $response = Http::get(env("EMAIL_TRANSFER_URL"));
        if($response->status() !== Response::HTTP_OK
           || Arr::get($response->json(), 'message') !== self::EMAIL_MESSAGE) {
            return false;
        }
        return true;
    }
}
