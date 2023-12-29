<?php

namespace Library;

/**
 * You must NOT change this class.
 * It represents a service we would have access through a third party library.
 * We don't have any control on it, it's API or the format of the returned data.
 */
class MyMovieServiceApi
{
    /**
     * @return array{id: int, title: string, year: string, score: int}
     */
    public function searchById(int $id): array
    {
        throw new \Exception('This class is mocked in the tests.');
    }

    /**
     * @return array{id: int, title: string, year: string, score: int}
     */
    public function searchByTitle(string $title): array
    {
        throw new \Exception('This class is mocked in the tests.');
    }

    /**
     * @return array{id: int, title: string, year: string, score: int}
     */
    public function searchByYear(int $year): array
    {
        throw new \Exception('This class is mocked in the tests.');
    }
}
