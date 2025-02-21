<?php

namespace Tests\Feature\LaravelStations\Station6;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station6')]
    public function test映画一覧に全ての映画のタイトル、画像URLが表示されているか(): void
    {
        $count = 12;
        for ($i = 0; $i < $count; $i++) {
            Movie::insert([
                'title' => 'タイトル' . $i,
                'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
                // 'published_year' => 2000 + $i, // ここに値を追加
                // 'description' => '概要' . $i,
                // 'is_showing' => (bool)random_int(0, 1),
            ]);
        }
        $movies = Movie::all();
        $response = $this->get('/movies');
        $response->assertStatus(200);
        foreach ($movies as $movie) {
            $response->assertSeeText($movie->title);
            $response->assertSee($movie->image_url);
        }
    }
}
