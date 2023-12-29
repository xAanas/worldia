<?php

namespace App\Domain;

final class TvShow extends Video
{
    public function __construct(int $id, string $title, int $year, ?int $rating = null, private int $numberOfSeasons = 1)
    {
        parent::__construct($id, $title, $year, $rating);
    }

    public function setNumberOfSeasons(int $numberOfSeasons): void
    {
        if ($numberOfSeasons < 1) {
            throw new \InvalidArgumentException("Number of seasons can't be less than 1.");
        }

        $this->numberOfSeasons = $numberOfSeasons;
    }

    public function getNumberOfSeasons(): int
    {
        return $this->numberOfSeasons;
    }
}
