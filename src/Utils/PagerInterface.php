<?php

namespace App\Utils;

interface PagerInterface
{
    public function renderer(int $totalCount): void;

    public function getCurrentPage(): int;

    public function setCurrentPage(int $currentPage): void;

    public function getNextPage();

    public function getPreviousPage();

    public function getDisplayNumbers(): array;

    public function getPageSize(): int;
}
