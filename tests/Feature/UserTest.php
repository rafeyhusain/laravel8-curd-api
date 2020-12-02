<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testUsersAreCreatedCorrectly()
    {
        $user = User::factory()->create();
        $payload = [
            'first_name' => 'Lorem',
            'last_name' => 'Ipsum',
        ];

        $this->json('POST', '/api/users', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'first_name' => 'Lorem', 'last_name' => 'Ipsum']);
    }

    public function testUsersAreUpdatedCorrectly()
    {
        $user = User::factory()->create([
            'first_name' => 'Lorem',
            'last_name' => 'Ipsum',
        ]);

        $payload = [
            'first_name' => 'Lorem1',
            'last_name' => 'Ipsum1',
        ];

        $response = $this->json('PUT', '/api/users/' . $user->id, $payload)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'title' => 'Lorem1', 
                'body' => 'Ipsum1' 
            ]);
    }

    public function testUsersAreDeletedCorrectly()
    {
        $user = User::factory()->create([
            'first_name' => 'Lorem',
            'last_name' => 'Ipsum',
        ]);

        $this->json('DELETE', '/api/users/' . $user->id, [], $headers)
            ->assertStatus(204);
    }

    public function testUsersAreListedCorrectly()
    {
        $list = [
            [ 'first_name' => 'Lorem1', 'last_name' => 'Ipsum1' ],
            [ 'first_name' => 'Lorem2', 'last_name' => 'Ipsum2' ],
        ];

        User::factory()->create($list[0]);
        User::factory()->create($list[1]);

        $response = $this->json('GET', '/api/users', [], $headers)
            ->assertStatus(200)
            ->assertJson($list)
            ->assertJsonStructure([
                '*' => [
                  'first_name'
                , 'last_name'
                , 'middle_name'
                , 'username'
                , 'full_name'
                , 'date_of_birth'],
            ]);
    }
}
