<?php

namespace App\Services;

use App\Utils\PagerInterface as Pager;
use App\Entity\Entry;

interface EntryServiceInterface{

    public function addEntry(Entry $entry): Entry;

    public function deleteEntry(int $id): void;

    public function updateEntry(Entry $entry): Entry;

    public function getEntry(int $id);

    /**
     * getEntries
     *
     * @param Pager $pager
     * @return mix
     */
    public function getEntries(Pager $pager);

    public function getTotalEntriesCount(): int;

    public function approveEntry(int $id): Entry;

    public function revokeEntry(int $id): Entry;

}