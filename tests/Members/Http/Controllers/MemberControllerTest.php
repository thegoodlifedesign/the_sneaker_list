<?php

class MemberControllerTest extends TestCase
{
    /** @test */
    public function it_gets_all_members()
    {
        $response = $this->call('GET', '/api/v1/rodzzlessa');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_includes_shoe_request_with_member()
    {
        $has_string = true;

        $response = $this->call('GET', '/api/v1/rodzzlessa?include=shoe_request');

        $is_string = strpos($response, 'shoe_request');

        if( ! $is_string) $has_string = false;

        $this->assertTrue($has_string);
    }
}