<?php

namespace App\Tests\Domain;

use App\Domain\Movie;

/**
 * @covers Movie
 */
final class MovieTest extends VideoTestCase
{
    protected function createVideo(int $id = 1, string $title = 'Title', int $year = 2023): Movie
    {
        return new Movie($id, $title, $year);
    }
}
