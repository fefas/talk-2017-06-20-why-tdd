<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use GuzzleHttp\Client as HttpClient;

class HttpClientContext implements Context
{
    private $httpResponse = null;

    /**
     * @When I request POST :uri with the following body:
     */
    public function iRequestPostWithTheFollowingBody($uri, PyStringNode $body)
    {
        $httpClient = new HttpClient([
            'base_uri' => 'http://nginx',
        ]);

        $this->httpResponse = $httpClient->post($uri, [
            'body' => $body->getRaw(),
        ]);
    }

    /**
     * @Then the response status code should be :expectedStatusCode
     */
    public function theResponseStatusCodeShouldBe($expectedStatusCode)
    {
        assertEquals($expectedStatusCode, $this->httpResponse->getStatusCode());
    }

    /**
     * @Then the response body should be empty
     */
    public function theResponseBodyShouldBeEmpty()
    {
        assertEmpty($this->httpResponse->getBody()->getContents());
    }
}
