<?php

namespace App\Domain;

abstract class Video
{
    public function __construct(private readonly int $id, private string $title, private int $year, private ?int $rating = null)
    {
        if ($this->year < 0) {
            throw new \InvalidArgumentException('Year must be positive.');
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): void
    {
        if ($rating < 0) {
            throw new \InvalidArgumentException('Rating must be positive.');
        }

        $this->rating = $rating;
    }
}
