<?php

namespace App\Services;

use App\Utils\Pager;

interface EntryServiceInterface{

    public function getEntryCollection();

    public function addEntry($data);

    public function deleteEntry(int $id);

    public function getEntry(int $id);

    public function getEntries(Pager $pager);

    public function getTotalEntriesCount(): int;

    public function approveEntry(int $id);

    public function revokeEntry(int $id);

}