<?php

namespace App\Tests\Domain;

use App\Domain\Movie;
use App\Domain\VideoProvider;
use App\Domain\TvShow;
use App\Infrastructure\Providers\Collection\VideoProviderCollection;
use App\Infrastructure\Providers\MovieProvider;
use App\Infrastructure\Providers\ProviderHandler\VideoProviderHandler;
use App\Infrastructure\Providers\TvShowProvider;
use Library\MyMovieServiceApi;
use Library\TheTvDatabaseApi;
use PHPUnit\Framework\TestCase;

/**
 * @covers VideoProvider
 */
final class VideoProviderTest extends TestCase
{
    private Movie $darkKnight;
    private TvShow $breakingBad;
    private MovieProvider $movieProvider;
    private TvShowProvider $tvShowProvider;

    protected function setUp(): void
    {
        $this->darkKnight = new Movie(155, 'The Dark Knight', 2008);
        $this->darkKnight->setRating(9);

        $this->breakingBad = new TvShow(52982, 'Breaking Bad', 2008);
        $this->breakingBad->setRating(8);

        $this->movieProvider = $this->getMockedMovieProvider();
        $this->tvShowProvider = $this->getMockedTvShowProvider();
    }

    public function testFindByYear(): void
    {
        $provider = new VideoProvider();
        $videoProviderCollection = new VideoProviderCollection();
        $videoProviderCollection->addVideoProvider($this->movieProvider);
        $videoProviderCollection->addVideoProvider($this->tvShowProvider);
        $provider->setVideoProviders($videoProviderCollection);

        $videos = $provider->findByYear(2008);

        $this->assertEqualsCanonicalizing([$this->darkKnight, $this->breakingBad], $videos);
    }

    private function getMockedMovieProvider(): MovieProvider
    {
        $provider = $this->getMockBuilder(MovieProvider::class)
            ->setConstructorArgs([new MyMovieServiceApi()])
            ->getMock();

        $provider->expects($this->any())
            ->method('findByYear')
            ->with(2008)
            ->willReturn([$this->darkKnight]);

        return $provider;
    }

    private function getMockedTvShowProvider(): TvShowProvider
    {
        $provider = $this->getMockBuilder(TvShowProvider::class)
            ->setConstructorArgs([new TheTvDatabaseApi()])
            ->getMock();

        $provider->expects($this->any())
            ->method('findByYear')
            ->with(2008)
            ->willReturn([$this->breakingBad]);

        return $provider;
    }
}
