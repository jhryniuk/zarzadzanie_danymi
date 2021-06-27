<?php

namespace App;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AuthService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function checkToken($token): array
    {
        $response = $this->client->request(
            'GET',
            "http://10.5.0.4/token/{$token}"
        );

        $statusCode = $response->getStatusCode();

        $content = ['status' => 'Invalid token'];
        if ($statusCode === Response::HTTP_OK) {
            $content = $response->toArray();
        }

        return $content;
    }
}
