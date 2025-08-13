<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginPageTest extends TestCase
{
    public function testLoginPageLoads()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login'); // Checks page has the word "Login"
    }
}
