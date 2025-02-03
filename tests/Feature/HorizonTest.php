<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Jobs\TestJob;

class HorizonTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_is_dispatched_to_horizon()
    {
        // Fake the queue to avoid actual execution
        Queue::fake();

        // Dispatch the test job
        TestJob::dispatch();

        // Assert the job was pushed to the queue
        Queue::assertPushed(TestJob::class);

        // Optionally, assert job was pushed with specific data
        Queue::assertPushed(TestJob::class, function ($job) {
            // Add conditions for your test
            return true;
        });
    }
}
