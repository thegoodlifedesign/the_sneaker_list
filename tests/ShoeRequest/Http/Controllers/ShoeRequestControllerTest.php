<?php

class ShoeRequestControllerTest extends TestCase
{
    /** @test */
    public function it_gets_all_the_shoe_requests()
    {
        $response = $this->call('GET', '/api/v1/shoe-requests');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_gets_a_shoe_request()
    {
        $response = $this->call('GET', '/api/v1/shoe-request/27837492');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_throws_error_when_shoe_request_does_not_exist()
    {
        $response = $this->call('GET', '/api/v1/shoe-request/278374945052');

        $this->assertEquals(404, $response->getStatusCode());
    }
}