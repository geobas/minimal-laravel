<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentsControllerTest extends TestCase
{
    public function testHomeAction()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $this->assertContains('Landon Hotel App', $response->getContent());
        $response->assertSeeText('West London')->assertDontSee('East London');
    }
}
