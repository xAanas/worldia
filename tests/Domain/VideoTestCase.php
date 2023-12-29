<?php

namespace App\Tests\Domain;

use App\Domain\Video;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers Video
 */
abstract class VideoTestCase extends TestCase
{
    public function testVideoYearMustBePositive(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('Year must be positive.'));

        $this->createVideo(1, 'Title', -1);
    }

    public function testVideoCanBeFromAPrehistoricalYear(): void
    {
        $video = $this->createVideo(1, 'Title', 1);

        $this->assertSame(1, $video->getYear());
    }

    public function testNewVideoIsCorrectlyInitialized(): void
    {
        $video = $this->createVideo(1, 'Title', 2023);

        $this->assertSame(1, $video->getId());
        $this->assertSame('Title', $video->getTitle());
        $this->assertSame(2023, $video->getYear());
    }

    public function testVideoHasNoRatingByDefault(): void
    {
        $video = $this->createVideo();

        $this->assertNull($video->getRating());
    }

    public function testRatingMustBePositive(): void
    {
        $video = $this->createVideo();

        $this->expectExceptionObject(new InvalidArgumentException('Rating must be positive.'));

        $video->setRating(-1);
    }

    public function testRatingCanBeUpdated(): void
    {
        $video = $this->createVideo();

        $video->setRating(3);

        $this->assertSame(3, $video->getRating());
    }

    public function testRatingCanBeRemoved(): void
    {
        $video = $this->createVideo();
        $video->setRating(3);

        $video->setRating(null);

        $this->assertNull($video->getRating());
    }

    abstract protected function createVideo(int $id = 1, string $title = 'Title', int $year = 2023): Video;
}
