<?php

namespace App\Services;

use App\Utils\Pager;
use App\Entity\Entry;

interface EntryServiceInterface{

    public function addEntry($data);

    public function deleteEntry(int $id);

    public function updateEntry(Entry $entry);

    public function getEntry(int $id);

    public function getEntries(Pager $pager);

    public function getTotalEntriesCount(): int;

    public function approveEntry(int $id);

    public function revokeEntry(int $id);

}