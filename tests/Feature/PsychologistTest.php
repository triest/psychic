<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class PsychologistTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_input()
    {
        $response = $this->post(route('guess-number'));
        $this->assertTrue(Session::has('gusses'));

        $response->assertStatus(200);
    }

   public function test_set_validation_fail_number()
    {
        $response = $this->postJson(
                route('make-input'),
                [   '_token' => csrf_token()]
        );
        $response->assertStatus(422);
    }

    public function test_set_validation_pass_number()
    {
        $response = $this->postJson(
                route('make-input'),
                ['number'=>32],
                [   '_token' => csrf_token()]
        );
        $response->assertStatus(302);
    }




}
