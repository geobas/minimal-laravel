<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Auth;

class ContentsControllerTest extends TestCase
{
	protected $response;

    protected function setUp()
    {
     	parent::setUp();
        $this->response = $this->get('/login');
        $this->response->assertStatus(200);
    }

    public function testLoginPage()
    {
        $this->assertContains('Login', $this->response->getContent());
        $this->response->assertSeeText('Remember Me')->assertDontSee('The original Landon perseveres');
    }

    public function testGuestUser()
    {
    	$this->assertTrue(Auth::guest());
    	$this->assertNull(Auth::user());
   		$this->assertGuest();
    }

	public function testLoggedInUser()
	{
		$user = factory(User::class)->create();
		$this->actingAs($user)->get('/')->assertStatus(200)->assertSeeText('And the not-to-miss Rooftop Cafe');
		$this->assertAuthenticated();
		$this->assertNotNull(Auth::user());
	}
}
