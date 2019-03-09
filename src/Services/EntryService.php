<?php

namespace App\Services;

use App\Manager\EntryManager;
use App\Utils\Pager;

class EntryService implements EntryServiceInterface{

    private $entryManager;
    private $pager;
    
    public function __construct(EntryManager $entryManager)
    {
        $this->entryManager = $entryManager;
    }

    public function getEntryCollection()
    {

    }

    public function addEntry($data)
    {
        return $this->entryManager->addEntry($data);
    }

    public function deleteEntry(){

    }

    public function getEntry(){

    }

    public function getEntries(Pager $pager)
    {
        $limit = $pager->getPageSize();
        $offset = ($pager->getCurrentPage()-1) * $limit;
        
        return $this->entryManager->getEntries($limit, $offset);
    }

    public function getTotalEntriesCount(): int
    {
        return $this->entryManager->getTotalEntriesCount();
    }
}