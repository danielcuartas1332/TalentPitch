<?php

namespace Tests\Unit;

use App\Models\Challenge;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_video()
    {
        $user = User::factory()->create();

        $video = Video::create([
            'url' => 'http://example.com/video.mp4',
            'name' => 'Sample Video',
            'description' => 'A sample video description',
            'user_id' => $user->id,
            'videoable_type' => 'App\\Models\\Challenge', // o el tipo de relación que estés usando
            'videoable_id' => 1, // Asegúrate de que este ID existe en la tabla correspondiente
        ]);

        $this->assertDatabaseHas('videos', [
            'url' => 'http://example.com/video.mp4',
            'name' => 'Sample Video',
            'description' => 'A sample video description',
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_requires_a_url()
    {
        $user = User::factory()->create();

        $this->expectException(QueryException::class);

        Video::create([
            'name' => 'Sample Video',
            'user_id' => $user->id,
            'videoable_type' => 'App\\Models\\Challenge',
            'videoable_id' => 1,
        ]);
    }

    #[Test]
    public function it_requires_a_name()
    {
        $user = User::factory()->create();

        $this->expectException(QueryException::class);

        Video::create([
            'url' => 'http://example.com/video.mp4',
            'description' => 'A sample video description',
            'user_id' => $user->id,
            'videoable_type' => 'App\\Models\\Challenge',
            'videoable_id' => 1,
        ]);
    }

    #[Test]
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $video->user);
    }

    #[Test]
    public function it_belongs_to_videoable()
    {
        // Asegúrate de que tienes una clase que puede ser `videoable`
        $challenge = Challenge::factory()->create();
        $user = User::factory()->create();

        $video = Video::factory()->create([
            'user_id' => $user->id,
            'videoable_type' => 'App\\Models\\Challenge',
            'videoable_id' => $challenge->id,
        ]);

        $this->assertInstanceOf(Challenge::class, $video->videoable);
    }
}
