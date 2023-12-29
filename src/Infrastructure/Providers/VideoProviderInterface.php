<?php

namespace App\Infrastructure\Providers;

interface VideoProviderInterface
{
    public function findById(int $id);
    public function findByYear(int $year): array;
    public function findByTitle(string $title): array;
}