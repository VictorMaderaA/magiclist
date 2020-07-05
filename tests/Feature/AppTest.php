<?php


namespace Tests\Feature;


use App\User;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * @return void
     */
    public function testLoadLogged()
    {
        self::be(factory(User::class)->create());
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testLoadGuest()
    {
        $response = $this->get(route('home'));
        $response->assertStatus(302);
    }
}
