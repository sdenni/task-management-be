<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_task()
    {
        $user = User::factory()->create(); // Create an authenticated user
        $this->actingAs($user, 'sanctum'); // Authenticate using Sanctum
        
        $taskData = [
          'title' => 'Test Task',
          'description' => 'Task description',
          'user_id' => $user->id,  // Pastikan user_id ada
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(201);
        $response->assertJson(['title' => 'Test Task']);
    }

    /** @test */
    public function authenticated_user_can_view_tasks()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum'); 
        
        $taskData = [
          'title' => 'Test Task',
          'description' => 'Task description',
          'user_id' => $user->id,
        ];

        Task::factory()->create($taskData);

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    /** @test */
    public function authenticated_user_can_update_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum'); 
        
        $taskData = [
          'user_id' => $user->id,
        ];

        $task = Task::factory()->create($taskData);

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['title' => 'Updated Task']);
    }

    /** @test */
    public function authenticated_user_can_delete_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum'); 
        
        $taskData = [
          'user_id' => $user->id,
        ];

        $task = Task::factory()->create($taskData);

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Task deleted successfully']);
    }
}
