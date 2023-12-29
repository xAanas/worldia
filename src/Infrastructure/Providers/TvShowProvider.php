<?php

namespace App\Infrastructure\Providers;

use App\Domain\TvShow;
use Library\TheTvDatabaseApi;

class TvShowProvider implements VideoProviderInterface
{
    public function __construct(private readonly TheTvDatabaseApi $api = new TheTvDatabaseApi())
    {
    }
    function findById(int $id): TvShow
    {
        if (!$id){
            throw new \InvalidArgumentException('Id cannot be empty.');
        }
        try {
            $data = $this->api->byId($id);
        }catch (\Throwable $e){
            throw new \Exception($e->getMessage());
        }

        return new TvShow($data['id'], $data['title'], (int) $data['year'], $data['score'], $data['numberOfSeasons']);
    }

    /**
     * @return TvShow[]
     */
    function findByYear(int $year): array
    {
        if (!$year){
            throw new \InvalidArgumentException('Year cannot be empty.');
        }

        $tvShows = [];
        try {
            foreach ($this->api->byYear($year) as $t) {
                $tvShows[] = new TvShow($t['id'], $t['title'], (int)$t['year'], $t['score'], $t['numberOfSeasons']);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $tvShows;
    }

    /**
     * @return TvShow[]
     */
    function findByTitle(string $title): array
    {
        if (!$title){
            throw new \InvalidArgumentException('Title cannot be empty.');
        }

        $tvShows = [];
        try {
            foreach ($this->api->byTitle($title) as $t) {
                $tvShows[] = new TvShow($t['id'], $t['title'], (int)$t['year'], $t['score'], $t['numberOfSeasons']);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $tvShows;
    }
}
