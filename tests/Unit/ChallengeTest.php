<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Challenge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;

class ChallengeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_challenge()
    {
        $user = User::factory()->create();

        $challenge = Challenge::create([
            'title' => 'New Challenge',
            'description' => 'Challenge Description',
            'difficulty' => 3,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('challenges', [
            'title' => 'New Challenge',
            'description' => 'Challenge Description',
            'difficulty' => 3,
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_requires_a_title()
    {
        $user = User::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        Challenge::create([
            'description' => 'Challenge Description',
            'difficulty' => 3,
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_requires_a_description()
    {
        $user = User::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        Challenge::create([
            'title' => 'New Challenge',
            'difficulty' => 3,
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_requires_a_difficulty()
    {
        $user = User::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        Challenge::create([
            'title' => 'New Challenge',
            'description' => 'Challenge Description',
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $challenge = Challenge::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $challenge->user);
    }
}
