<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Auth;

class ContentsControllerTest extends TestCase
{
	protected $response;

    protected function setUp()
    {
     	parent::setUp();
    }

    public function testLoginPage()
    {
        $this->response = $this->call('GET', '/login');
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertContains('Login', $this->response->getContent());
        $this->assertContains('Remember Me', $this->response->getContent());
        $this->assertNotContains('The original Landon perseveres', $this->response->getContent());
    }


    public function testGuestUser()
    {
    	$this->assertTrue(Auth::guest());
    	$this->assertNull(Auth::user());
    }

	public function testLoggedInUser()
	{
		$user = factory(User::class)->create();
		$this->actingAs($user);
        $this->response = $this->call('GET', '/');
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertContains('And the not-to-miss Rooftop Cafe', $this->response->getContent());
        $this->assertFalse(Auth::guest());
	}
}
