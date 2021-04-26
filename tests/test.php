<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class WelcomeTest extends TestCase
{

    protected function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://wordpress/']);
    }

    public function testFirst()
    {
        $response = $this->http->request('GET', '');
        //var_dump($response->getBody());
    }

    public function tearDown()
    {
        $this->http = null;
    }

}
