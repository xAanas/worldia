<?php

namespace App\Tests\Infrastructure\Providers;

use App\Infrastructure\Providers\MovieProvider;
use Library\MyMovieServiceApi;
use PHPUnit\Framework\TestCase;

/**
 * @covers MovieProvider
 */
final class MovieProviderTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testFindAMovieById(): void
    {
        $provider = new MovieProvider($this->getMockedClient());
        $movie = $provider->findById(155);

        $this->assertNotNull($movie);
        $this->assertSame(155, $movie->getId());
        $this->assertSame('The Dark Knight', $movie->getTitle());
        $this->assertSame(9, $movie->getRating());
        $this->assertSame(2008, $movie->getYear());
    }

    public function testfindMovieByTitle(): void
    {
        $provider = new MovieProvider($this->getMockedClient());
        $movies = $provider->findByTitle('The Dark Knight');

        $this->assertNotEmpty($movies);
        $movie = $movies[0];
        $this->assertSame(155, $movie->getId());
        $this->assertSame('The Dark Knight', $movie->getTitle());
        $this->assertSame(9, $movie->getRating());
        $this->assertSame(2008, $movie->getYear());
    }

    public function testfindMovieByYear(): void
    {
        $provider = new MovieProvider($this->getMockedClient());
        $movies = $provider->findByYear(2008);

        $this->assertNotEmpty($movies);
        $movie = $movies[0];
        $this->assertSame(155, $movie->getId());
        $this->assertSame('The Dark Knight', $movie->getTitle());
        $this->assertSame(9, $movie->getRating());
        $this->assertSame(2008, $movie->getYear());
    }

    private function getMockedClient(): MyMovieServiceApi
    {
        $client = $this->getMockBuilder(MyMovieServiceApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $result = [
            'title' => 'The Dark Knight',
            'year' => 2008,
            'score' => 9,
            'id' => 155,
        ];

        $client->expects($this->any())
            ->method('searchById')
            ->with(155)
            ->willReturn($result);

        $client->expects($this->any())
            ->method('searchByTitle')
            ->with('The Dark Knight')
            ->willReturn([$result]);

        $client->expects($this->any())
            ->method('searchByYear')
            ->with(2008)
            ->willReturn([$result]);

        return $client;
    }
}
