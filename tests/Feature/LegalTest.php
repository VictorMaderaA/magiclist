<?php


namespace Tests\Feature;


use Tests\TestCase;

class LegalTest extends TestCase
{

    public function testLoadTerms(){
        $response = $this->get(route('legal_terms'));
        $response->assertStatus(200);
    }

    public function testLoadPrivacy(){
        $response = $this->get(route('legal_privacy'));
        $response->assertStatus(200);
    }

    public function testLoadCookies(){
        $response = $this->get(route('legal_cookies'));
        $response->assertStatus(200);
    }

}
