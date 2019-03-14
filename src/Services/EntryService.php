<?php

namespace App\Services;

use App\Entity\Entry;
use App\Manager\EntryManagerInterface as EntryManager;
use App\Utils\PagerInterface as Pager;

class EntryService implements EntryServiceInterface{

    private $entryManager;
    private $pager;
    
    public function __construct(EntryManager $entryManager)
    {
        $this->entryManager = $entryManager;
    }

    public function approveEntry(int $id)
    {
        return $this->entryManager->approveEntry($id);
    }

    public function revokeEntry(int $id)
    {
        return $this->entryManager->revokeEntry($id);
    }

    public function addEntry(Entry $entry)
    {
        return $this->entryManager->addEntry($entry);
    }

    public function updateEntry(Entry $entry){
        return $this->entryManager->updateEntry($entry);
    }

    public function deleteEntry(int $id){
        return $this->entryManager->deleteEntry($id);
    }

    public function getEntry(int $id){
        return $this->entryManager->getEntry($id);
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