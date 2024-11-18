<?php

namespace Tests\Feature;

use App\Livewire\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    public function test_it_can_add_and_display_notification() : void
    {
        $key = 'success-test-'.time();

        \Livewire::test(Notification::class)
            ->call('notify', 'success', $key)
            ->assertSee($key)
        ;
    }
}
