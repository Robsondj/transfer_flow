<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TransferTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     * @return void
     */
    public function test_transfer_feature_is_working()
    {
        $payload = [
            "payer" => 1,
            "payee" => 2,
            "value" => 50.5
        ];

        $response = $this->post('/api/transfer/', $payload);
        $data = $response->getOriginalContent();

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals('success', $data["message"]);
    }
    
    /**
     *
     * @return void
     */
    public function test_transfer_without_balance()
    {
        $payload = [
            "payer" => 1,
            "payee" => 2,
            "value" => 50000
        ];

        $response = $this->post('/api/transfer/', $payload);
        $data = $response->getOriginalContent();

        $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE);
        $this->assertEquals('Insufficient balance for this transfer.', $data["errors"]);
    }
    
    /**
     *
     * @return void
     */
    public function test_transfer_between_enterprises()
    {
        $payload = [
            "payer" => 6,
            "payee" => 7,
            "value" => 50.5
        ];

        $response = $this->post('/api/transfer/', $payload);
        $data = $response->getOriginalContent();

        $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE);
        $this->assertEquals('Only individuals can make transfers.', $data["errors"]);
    }
    
    /**
     *
     * @return void
     */
    public function test_transfer_for_equals_payer_and_payee()
    {
        $payload = [
            "payer" => 1,
            "payee" => 1,
            "value" => 50.5
        ];

        $response = $this->post('/api/transfer/', $payload);
        $data = $response->getOriginalContent();

        $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE);
        $this->assertEquals('Payee and Payer can not be the same.', $data["errors"]);
    }
}
