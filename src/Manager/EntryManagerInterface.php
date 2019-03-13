<?php

namespace App\Manager;

interface EntryManagerInterface{

    public function addEntry($data);

    public function updateEntry(int $id, $data);

    public function deleteEntry(int $id);

    public function getEntry(int $id);

    public function approveEntry(int $id);

    public function revokeEntry(int $id);

    public function getEntries(int $limit, int $offset);

    public function getTotalEntriesCount(): int;
}