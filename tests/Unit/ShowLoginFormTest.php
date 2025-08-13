<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ShowLoginFormTest extends TestCase
{
    public function testShowLoginFormReturnsCorrectView()
    {
        // Arrange: mock the Log facade
        Log::shouldReceive('info')
            ->once()
            ->with('Showing login form');

        $controller = new LoginController();

        // Act
        $response = $controller->showLoginForm();

        // Assert
        $this->assertEquals('frontend.user.login', $response->name());
    }
}
