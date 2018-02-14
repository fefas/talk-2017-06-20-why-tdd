<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as HttpClientExpcetion;

class HttpClientContext implements Context
{
    private $client;
    private $response;

    public function __construct()
    {
        $this->client = new HttpClient([
            'base_uri' => 'http://nginx',
        ]);

    }

    /**
     * @When I request POST :uri with the following body:
     */
    public function iRequestPostWithTheFollowingBody($uri, PyStringNode $body)
    {
        try {
            $this->response = $httpClient->post($uri, [
                'body' => $body->getRaw(),
            ]);
        } catch (HttpClientExpcetion $e) {
            $this->response = $e->getResponse();
        }
    }

    /**
     * @Then the response status code should be :expectedStatusCode
     */
    public function theResponseStatusCodeShouldBe($expectedStatusCode)
    {
        $statusCode = $this->response->getStatusCode();

        assertEquals($expectedStatusCode, $statusCode);
    }

    /**
     * @Then the response body should be empty
     */
    public function theResponseBodyShouldBeEmpty()
    {
        $body = $this->response->getBody()->getContents();

        assertEmpty($body);
    }

   /**
     * @Then the response body should be:
     */
    public function theResponseBodyShouldBe(string $expectedBody)
    {
        $body = $this->response->getBody()->getContents();

        assertJsonStringEqualsJsonString($expectedBody, $body);
    }
}
