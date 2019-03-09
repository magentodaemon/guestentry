<?php

namespace App\Services;

use App\Utils\Pager;

interface EntryServiceInterface{

    public function getEntryCollection();

    public function addEntry($data);

    public function deleteEntry();

    public function getEntry();

    public function getEntries(Pager $pager);

    public function getTotalEntriesCount(): int;

}