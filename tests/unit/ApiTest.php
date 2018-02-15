<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as HttpClientExpcetion;

class ApiTest extends TestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = new HttpClient([
            'base_uri' => 'http://nginx',
        ]);
    }

    /**
     * @test
     */
    public function shouldReturn200IfUsernameIsValid()
    {
        $response = $this->request('POST', '/check-username', '{"username":"fefas"}');

        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $this->assertEquals(200, $statusCode);
        $this->assertEmpty($body);
    }

    /**
     * @test
     */
    public function shouldReturn422IfNoUsernameIsProvided()
    {
        $response = $this->request('POST', '/check-username', '{}');

        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $this->assertEquals(422, $statusCode);
        $this->assertJsonStringEqualsJsonString(
            '{"message":"The field \'username\' is missing"}',
            $body
        );
    }

    /**
     * @test
     */
    public function shouldReturn422IfUsernameIsInvalid()
    {
        $response = $this->request('POST', '/check-username', '{"username":"-fefas"}');

        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $this->assertEquals(422, $statusCode);
        $this->assertJsonStringEqualsJsonString(
            '{"message":"The \'username\' is not properly formatted"}',
            $body
        );
    }

    private function request(string $method, string $uri, string $body)
    {
        try {
            return $this->client->request($method, $uri, [
                'body' => $body,
            ]);
        } catch (HttpClientExpcetion $e) {
            return $e->getResponse();
        }
    }
}
