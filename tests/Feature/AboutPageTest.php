<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutPageTest extends TestCase
{

    public function testCanViewLandingPage()
    {
        $resp = $this->get('/');

        $resp->assertStatus(200);
        $resp->assertSee("Školská Správa");

    }
}
