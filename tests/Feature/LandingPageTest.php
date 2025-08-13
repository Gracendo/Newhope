<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * Test that the home page loads successfully.
     */
    public function testLandingPageLoads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Blog');
    }
}
