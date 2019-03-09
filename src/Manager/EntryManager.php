<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Entry;

class EntryManager implements EntryManagerInterface{

    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }


    public function addEntry($entry){

        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;

    }

    public function updateEntry(int $id, $data)
    {
        $entry = $this->entityManager
            ->getRepository(Entry::class)
            ->find($id);

        if (!$entry)
            throw Exception("Entry not found");
        
        if(isset($data['title']))
            $entry->setTitle($data['title']);
        
        if(isset($data['type']))
            $entry->setType($data['type']);
        
        if(isset($data['detail']))
            $entry->setDetail($data['detail']);
    
        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;
    }

    public function deleteEntry(int $id){

        $entry = $this->entityManager
            ->getRepository(Entry::class)
            ->find($id);

        if (!$entry)
            throw Exception("Entry not found");

        $this->entityManager->remove($entry);
        $this->entityManager->flush();
    }

    public function getEntries(int $limit,int $offset)
    {
        $entries = $this->entityManager
            ->getRepository(Entry::class)
            ->findBy([], [], $limit , $offset);
        
        return $entries;
    }

    public function getTotalEntriesCount(): int
    {   
        return $this->entityManager
            ->getRepository(Entry::class)
            ->count([]);
    }

}