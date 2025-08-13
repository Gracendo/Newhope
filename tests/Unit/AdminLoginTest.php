<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    public function testPendingAdminCannotLogin()
    {
        // Arrange: fake admin object
        $adminMock = new \stdClass();
        $adminMock->id = 1;
        $adminMock->status = 'pending';

        // Mock the admin guard
        Auth::shouldReceive('guard->attempt')
            ->once()
            ->andReturn(true);

        Auth::shouldReceive('guard->user')
            ->once()
            ->andReturn($adminMock);

        Auth::shouldReceive('guard->logout')
            ->once();

        // Expect log calls
        Log::shouldReceive('info')->once();
        Log::shouldReceive('debug')->once();
        Log::shouldReceive('warning')->once();

        $controller = new LoginController();
        $request = Request::create('/admin/login', 'POST', [
            'username' => 'adminuser',
            'password' => 'adminpass',
        ]);

        // Act
        $response = $controller->adminLogin($request);

        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('pending admin approval', $response->getContent());
    }
}
