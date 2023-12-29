<?php

namespace App\Infrastructure\Providers\ProviderHandler;

use App\Domain\VideoProvider;
use App\Infrastructure\Providers\Collection\VideoProviderCollection;
use App\Infrastructure\Providers\MovieProvider;

/*
 * We call this class anywhere if needed to get a new VideoProvider instance configured with all the available providers
 * VideoProviderHandler::getVideoProvider()
 */
class VideoProviderHandler
{
    /*
     * If we add a new provider e.g : CartoonProvider, all we have to do is to add 'Cartoon' to this array
     */
    const videoProviderConfigurations = [
        'Movie',
        'TvShow'
    ];
    const PROVIDER_PREFIX = '\\App\Infrastructure\Providers\\';

    public static function getVideoProvider(): VideoProvider{
        $videoProvider = new VideoProvider();
        $videoProviderCollection = new VideoProviderCollection();
        foreach (self::videoProviderConfigurations as $videoType){
            $providerName  = self::PROVIDER_PREFIX.$videoType.'Provider';
            $videoProviderCollection->addVideoProvider(new $providerName());
        }
        $videoProvider->setVideoProviders($videoProviderCollection);
        return $videoProvider;
    }
}