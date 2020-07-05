<?php


namespace Tests\Feature;


use Tests\TestCase;

class WelcomeTest extends TestCase
{

    /**
     * @return void
     */
    public function testLoad()
    {
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
    }


}
