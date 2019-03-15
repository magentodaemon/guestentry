<?php

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use App\Entity\Entry;
use App\Manager\EntryManager;
use App\Manager\EntryManagerInterface;
use App\Repository\EntryRepository;

class EntryManagerTest extends TestCase
{
    private $entityManager;
    private $entry;

    public function __construct()
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->entry = $this->createMock(Entry::class);
        parent::__construct();
    }

    public function testShouldbeAnInstanceofEntryManager()
    {
        $entryManager = new EntryManager($this->entityManager);
        $this->assertInstanceOf(EntryManagerInterface::class, $entryManager);
    }

    public function testShouldAddEntry()
    {
        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($this->entry);

        $this->entityManager->expects($this->once())
            ->method('flush');

        $entryManager = new EntryManager($this->entityManager);

        $this->assertInstanceOf(
            Entry::class,
            $entryManager->addEntry($this->entry)
        );
    }

    public function testShouldUpdateEntry()
    {
        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($this->entry);

        $this->entityManager->expects($this->once())
            ->method('flush');

        $entryManager = new EntryManager($this->entityManager);

        $this->assertInstanceOf(
            Entry::class,
            $entryManager->updateEntry($this->entry)
        );
    }

    public function testShouldApproveEntry()
    {
        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn($this->entry);

        $this->entry
            ->expects($this->once())
            ->method('setIsApproved')
            ->with(true);

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->entry);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $entryManager = new EntryManager($this->entityManager);

        $this->assertInstanceOf(
            Entry::class,
            $entryManager->approveEntry($entryId)
        );
    }

    public function testShouldThrowExceptionForApprovalIfEntryNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Entry not found');

        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn(false);

        $entryManager = new EntryManager($this->entityManager);

        $entryManager->approveEntry($entryId);
    }

    public function testShouldRevokeEntry()
    {
        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn($this->entry);

        $this->entry
            ->expects($this->once())
            ->method('setIsApproved')
            ->with(false);

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->entry);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $entryManager = new EntryManager($this->entityManager);

        $this->assertInstanceOf(
            Entry::class,
            $entryManager->revokeEntry($entryId)
        );
    }

    public function testShouldThrowExceptionForRevokeIfEntryNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Entry not found');

        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn(false);

        $entryManager = new EntryManager($this->entityManager);

        $entryManager->revokeEntry($entryId);
    }

    public function testShouldDeleteEntry()
    {
        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn($this->entry);

        $this->entityManager
            ->expects($this->once())
            ->method('remove')
            ->with($this->entry);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $entryManager = new EntryManager($this->entityManager);

        $entryManager->deleteEntry($entryId);
    }

    public function testShouldThrowExceptionForDeleteIfEntryNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Entry not found');

        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn(false);

        $entryManager = new EntryManager($this->entityManager);

        $entryManager->deleteEntry($entryId);
    }

    public function testShouldReturnEntry()
    {
        $entryId = 11;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('find')
            ->with($entryId)
            ->willReturn($this->entry);

        $entryManager = new EntryManager($this->entityManager);

        $this->assertInstanceOf(
            Entry::class,
            $entryManager->getEntry($entryId)
        );
    }

    public function testShouldReturnEntries()
    {
        $limit = 10;
        $offset = 0;

        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('findBy')
            ->with([], [], $limit, $offset)
            ->willReturn([$this->entry]);

        $entryManager = new EntryManager($this->entityManager);

        $this->assertSame(
            [$this->entry],
            $entryManager->getEntries($limit, $offset)
        );
    }

    public function testShouldGetCount()
    {
        $count = 134;
        $entryRepository = $this->createMock(EntryRepository::class);

        $this->entityManager
            ->method('getRepository')
            ->with(Entry::class)
            ->willReturn($entryRepository);

        $entryRepository
            ->method('count')
            ->with([])
            ->willReturn($count);

        $entryManager = new EntryManager($this->entityManager);

        $this->assertSame(
            $count,
            $entryManager->getTotalEntriesCount()
        );
    }
}
