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
        $response = $this->call('GET', '/api/v1/shoe-request/77902669');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_includes_member_with_shoe_request()
    {
        $has_string = true;

        $response = $this->call('GET', '/api/v1/shoe-request/77902669?include=member');

        $is_string = strpos($response, 'member');

        if( ! $is_string) $has_string = false;

        $this->assertTrue($has_string);
    }

    /** @test */
    public function it_throws_error_when_shoe_request_does_not_exist()
    {
        $response = $this->call('GET', '/api/v1/shoe-request/7790254669');

        $this->assertEquals(404, $response->getStatusCode());
    }
}