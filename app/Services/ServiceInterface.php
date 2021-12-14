<?php

namespace App\Services;

interface ServiceInterface
{

    /**
     * Method to call service functionalities
     *
     * @param array $data|null
     * @return mixed
     */
    public function run($data): mixed;
}
