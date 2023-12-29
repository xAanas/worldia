<?php

namespace App\Infrastructure\Providers;

use App\Domain\Movie;
use Library\MyMovieServiceApi;

class MovieProvider implements VideoProviderInterface
{
    public function __construct(private readonly MyMovieServiceApi $api = new MyMovieServiceApi())
    {
    }

    function findById($id): Movie
    {
        if (!$id){
            throw new \InvalidArgumentException('Id cannot be empty.');
        }
        try {
            $movie = $this->api->searchById($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }

        return new Movie($movie['id'], $movie['title'], (int)$movie['year'], $movie['score']);
    }

    /**
     * @return Movie[]
     */
    function findByYear(int $year): array
    {
        if (!$year){
            throw new \InvalidArgumentException('Year cannot be empty.');
        }

        $movies = [];
        try {
            foreach ($this->api->searchByYear($year) as $movie) {
                $movies[] = new Movie($movie['id'], $movie['title'], (int)$movie['year'], $movie['score']);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $movies;
    }

    /**
     * @return Movie[]
     */
    function findByTitle($title): array
    {
        if (!$title){
           throw new \InvalidArgumentException('Title cannot be empty.');
        }

        $movies = [];
        try {
            foreach ($this->api->searchByTitle($title) as $data) {
                $movies[] = new Movie($data['id'], $data['title'], (int) $data['year'], $data['score']);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $movies;
    }
}
