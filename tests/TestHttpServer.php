<?php

use \pillr\library\http\Request  as HttpRequest;
use \pillr\library\http\Response as HttpResponse;
use \pillr\library\http\Uri      as Uri;

class TestHttpServer extends \PHPUnit_Framework_TestCase {

    public function testRequest()
    {
        // *
 // * - Protocol version
 // * - HTTP method
 // * - URI
 // * - Headers
 // * - Message body

        $uri_string = 'https://pillrcompany.com/intern/test?psr=true';

        $httpRequest =  new HttpRequest(
            '1.1',
            'GET',
            new Uri($uri_string),
            array('Accept' => 'application/json'),
            ''
        );

        $this->assertEquals(
            $httpRequest->getRequestTarget(),
            $uri_string
        );

        $this->assertEquals(
            $httpRequest->getMethod(),
            'GET'
        );

        $this->assertEquals(
            $httpRequest->getUri(),
            new Uri($uri_string)
        );

        $this->assertEquals(
            $httpRequest->withRequestTarget('https://pillrcompany.com/intern/alt'),
            new HttpRequest( Uri('https://pillrcompany.com/intern/alt') )
        );

    }

    public function testResponse()
    {

 // - Protocol version
 // * - Status code and reason phrase
 // * - Headers
 // * - Message body
 
        $httpResponse =  new HttpRequest(
            '1.1',
            '200 OK',
            array('Content-Type' => 'application/json'),
            'hello'
        );

        $httpResponseAlt =  new HttpRequest(
            '1.1',
            '404 Not Found',
            array('Content-Type' => 'application/json'),
            'hello'
        );

        $this->assertEquals($httpResponse->getStatusCode(), '200');

        $this->assertEquals(
            $httpResponse->withStatus('404', 'Not Found'),
            $httpResponseAlt
        );
    }
}