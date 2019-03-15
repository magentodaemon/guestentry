<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface as EntityManager;
use App\Entity\Entry;

class EntryManager implements EntryManagerInterface
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function addEntry(Entry $entry): Entry
    {
        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;
    }

    public function updateEntry(Entry $entry): Entry
    {
        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;
    }

    public function approveEntry(int $id): Entry
    {
        $entry = $this->entityManager
            ->getRepository(Entry::class)
            ->find($id);

        if (!$entry) {
            throw new \Exception('Entry not found');
        }
        $entry->setIsApproved(true);

        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;
    }

    public function revokeEntry(int $id): Entry
    {
        $entry = $this->entityManager
            ->getRepository(Entry::class)
            ->find($id);

        if (!$entry) {
            throw new \Exception('Entry not found');
        }
        $entry->setIsApproved(false);

        $this->entityManager->persist($entry);
        $this->entityManager->flush();

        return $entry;
    }

    public function deleteEntry(int $id)
    {
        $entry = $this->entityManager
            ->getRepository(Entry::class)
            ->find($id);

        if (!$entry) {
            throw new \Exception('Entry not found');
        }
        $this->entityManager->remove($entry);
        $this->entityManager->flush();
    }

    public function getEntry(int $id): Entry
    {
        return $this->entityManager
                ->getRepository(Entry::class)
                ->find($id);
    }

    public function getEntries(int $limit, int $offset)
    {
        $entries = $this->entityManager
            ->getRepository(Entry::class)
            ->findBy([], [], $limit, $offset);

        return $entries;
    }

    public function getTotalEntriesCount(): int
    {
        return $this->entityManager
            ->getRepository(Entry::class)
            ->count([]);
    }
}
