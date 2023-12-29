<?php

namespace App\Infrastructure\Providers\Collection;

use App\Infrastructure\Providers\VideoProviderInterface;

class VideoProviderCollection
{
    /*
     * VideoProviderInterface[]
     */
    private array $videoProviders;

    public function setVideoProviders(array $videoProviders){
        $this->videoProviders = $videoProviders;
    }

    public function getVideoProviders(): array
    {
        return $this->videoProviders;
    }

    public function addVideoProvider(VideoProviderInterface $videoProvider){
        $this->videoProviders[] = $videoProvider;
    }
}