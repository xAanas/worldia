<?php

namespace App\Tests\Domain;

use App\Domain\TvShow;
use InvalidArgumentException;

/**
 * @covers TvShow
 */
final class TvShowTest extends VideoTestCase
{
    public function testHasOneSeasonByDefault(): void
    {
        $bigBangTheory = $this->createBigBangTheoryTvShow();

        $this->assertSame(1, $bigBangTheory->getNumberOfSeasons());
    }

    public function testNumberOfSeasonMustBeGreaterThanZero(): void
    {
        $bigBangTheory = $this->createBigBangTheoryTvShow();

        $this->expectExceptionObject(new InvalidArgumentException("Number of seasons can't be less than 1."));

        $bigBangTheory->setNumberOfSeasons(0);
    }

    public function testUpdateNumberOfSeasons(): void
    {
        $bigBangTheory = $this->createBigBangTheoryTvShow();

        $bigBangTheory->setNumberOfSeasons(12);

        $this->assertSame(12, $bigBangTheory->getNumberOfSeasons());
    }

    protected function createVideo(int $id = 1, string $title = 'Title', int $year = 2023): TvShow
    {
        return new TvShow($id, $title, $year);
    }

    private function createBigBangTheoryTvShow(): TvShow
    {
        return $this->createVideo(1, 'Big Bang Theory', 2007);
    }
}
