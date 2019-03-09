<?php

namespace App\Manager;

interface EntryManagerInterface{

    public function addEntry($data);

    public function updateEntry(int $id, $data);

    public function deleteEntry(int $id);

    public function getEntries(int $limit, int $offset);

    public function getTotalEntriesCount(): int;
}