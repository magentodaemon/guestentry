<?php

namespace App\Manager;

use App\Entity\Entry;

interface EntryManagerInterface
{
    public function addEntry(Entry $entry): Entry;

    public function updateEntry(Entry $entry): Entry;

    public function deleteEntry(int $id);

    public function getEntry(int $id): Entry;

    public function approveEntry(int $id): Entry;

    public function revokeEntry(int $id): Entry;

    public function getEntries(int $limit, int $offset);

    public function getTotalEntriesCount(): int;
}
