<?php

namespace App\Utils;

class Pager implements PagerInterface
{
    private $totalCount = 0;

    private $previousPage = false;

    private $nextPage = false;

    private $displayNumbers = [];

    private $currentPage = 1;

    private $pageSize = 10;

    private $lastPage = false;

    public function renderer(int $totalCount)
    {
        $this->totalCount = $totalCount;
        $this->lastPage = ceil($this->totalCount / $this->pageSize );

        if($this->currentPage <= 1)
            $this->previousPage = false;
        else
            $this->previousPage = $this->currentPage - 1;

        if($this->currentPage >= $this->lastPage)
            $this->nextPage = false;
        else
            $this->nextPage = $this->currentPage + 1;

        $pageNumber = $this->currentPage;

        for($i=0;$i<2;$i++)
        {
            $pageNumber = $pageNumber + $i;

            if($pageNumber > $this->lastPage)
                break;

            $this->displayNumbers[] = $pageNumber;
        }
    }

    public function getCurrentPage() : int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    public function getNextPage()
    {
        return $this->nextPage;
    }

    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    public function getDisplayNumbers(): array
    {
        return $this->displayNumbers;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }
}