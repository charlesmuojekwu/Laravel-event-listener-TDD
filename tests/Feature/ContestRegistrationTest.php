<?php

namespace Tests\Feature;

use App\Events\NewEntryRecievedEvent;
use App\Mail\WelcomeContestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // Event::fake([
        //     NewEntryRecievedEvent::class
        // ]);

        //Event::fake();

        Mail::fake();
    }


    /** @test */
    public function an_email_can_be_entered_into_the_contest()
    {
        //$this->withExceptionHandling();

        $this->post('/contest', [
            'email' => 'abc@abc.com',
        ]);

        $this->assertDatabaseCount('contest_entries', 1);
    }


    /**
     * A basic test example.
     *
     * @test
     */
    public function email_is_required()
    {

        $this->withExceptionHandling();

        $this->post('/contest', [
            'email' => '',
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }


    /** @test
     * @group email
     */
    public function an_event_is_fired_when_user_register()
    {
        Event::fake([
            NewEntryRecievedEvent::class
        ]);

        $this->withExceptionHandling();

        $this->post('/contest', [
            'email' => 'mike@mail.com',
        ]);

        Event::assertDispatched(NewEntryRecievedEvent::class);
    }


    /** @test */
    public function a_welcome_email_set()
    {
        $this->post('/contest', [
            'email' => 'abc@abc.com',
        ]);

        Mail::assertQueued(WelcomeContestMail::class);
    }
}
