<?php

namespace App\Manager;

use App\Entity\Entry;

interface EntryManagerInterface{

    public function addEntry($data);

    public function updateEntry(Entry $entry);

    public function deleteEntry(int $id);

    public function getEntry(int $id);

    public function approveEntry(int $id);

    public function revokeEntry(int $id);

    public function getEntries(int $limit, int $offset);

    public function getTotalEntriesCount(): int;
}