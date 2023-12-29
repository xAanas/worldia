<?php

namespace App\Domain;

use App\Infrastructure\Providers\Collection\VideoProviderCollection;
use App\Infrastructure\Providers\MovieProvider;
use App\Infrastructure\Providers\TvShowProvider;
use Library\MyMovieServiceApi;
use Library\TheTvDatabaseApi;

class VideoProvider
{
    private VideoProviderCollection $videoProviders;

    public function setVideoProviders(VideoProviderCollection $videoProviders): void
    {
        $this->videoProviders = $videoProviders;
    }


    /**
     * @return Video[]
     */
    public function findByYear(int $year): array
    {
        $result = [];

        foreach ($this->videoProviders->getVideoProviders() as $videoProvider){
            $result = array_merge(
                $result,
                $videoProvider->findByYear($year),
            );
        }
        return $result;
    }

    /**
     * @return Video[]
     */
    public function findByTitle(string $title): array
    {
        $result = [];
        foreach ($this->videoProviders->getVideoProviders() as $videoProvider){
            $result = array_merge(
                $result,
                $videoProvider->findByTitle($title),
            );
        }
        return $result;
    }
}
