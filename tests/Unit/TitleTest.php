<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Title;

class TitleTest extends TestCase
{
    protected $titles;

    protected function setUp()
    {
        $this->titles = new Title();
    }

    public function testTitlesCount()
    {
        $this->assertEquals(count($this->titles->all()), 2, 'All titles should be 2.');
    }

    public function testTitlesContent()
    {
        $this->assertEquals($this->titles->get(0), 'Mr');
    }

    protected function tearDown()
    {
        unset($this->titles);
    }
}
