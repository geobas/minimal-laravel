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
        $this->assertCount(2, $this->titles->all(), 'Wrong number of titles.');
    }

    public function testTitlesContent()
    {
        $this->assertEquals('Mr', $this->titles->get(0));
    }

    protected function tearDown()
    {
        unset($this->titles);
    }
}
