<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Entry;
use App\Manager\EntryManagerInterface as EntryManager;
use App\Services\EntryService;
use App\Services\EntryServiceInterface;
use App\Utils\PagerInterface as Pager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EntryServiceTest extends TestCase{

    CONST ENTRY_ID = 11;

    private $entryManager;
    private $entry;

    public function __construct(){
        $this->entryManager = $this->createMock(EntryManager::class);
        $this->entry = $this->createMock(Entry::class);
        parent::__construct();
    }

    public function testShouldbeAnInstanceofEntryService(){
        $entryService = new EntryService($this->entryManager);
        $this->assertInstanceOf(EntryServiceInterface::class,$entryService);

    }

    public function testShouldApproveEntry(){
        $this->entryManager
            ->method('approveEntry')
            ->with(self::ENTRY_ID)
            ->willReturn($this->entry);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertInstanceOf(
            Entry::class,
            $entryService->approveEntry(self::ENTRY_ID)
        );
    }

    public function testShouldRevokeEntry(){
        $this->entryManager
            ->method('revokeEntry')
            ->with(self::ENTRY_ID)
            ->willReturn($this->entry);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertInstanceOf(
            Entry::class,
            $entryService->revokeEntry(self::ENTRY_ID)
        );
    }

    public function testShouldDeleteEntry(){
        $this->entryManager
            ->method('deleteEntry')
            ->with(self::ENTRY_ID)
            ->willReturn($this->entry);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertInstanceOf(
            Entry::class,
            $entryService->deleteEntry(self::ENTRY_ID)
        );
    }

    public function testShouldgetEntry(){
        $this->entryManager
            ->method('getEntry')
            ->with(self::ENTRY_ID)
            ->willReturn($this->entry);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertInstanceOf(
            Entry::class,
            $entryService->getEntry(self::ENTRY_ID)
        );
    }

    public function testShouldAddEntry(){
        $this->entryManager
            ->method('addEntry')
            ->with($this->entry)
            ->willReturn($this->entry);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertInstanceOf(
            Entry::class,
            $entryService->addEntry($this->entry)
        );
    }

    public function testShouldUpdateEntry(){
        $this->entryManager
            ->method('updateEntry')
            ->with($this->entry)
            ->willReturn($this->entry);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertInstanceOf(
            Entry::class,
            $entryService->updateEntry($this->entry)
        );
    }

    public function testShouldGetTotalEntryCount(){
        $count =134;

        $this->entryManager
            ->method('getTotalEntriesCount')
            ->willReturn($count);

        $entryService = new EntryService($this->entryManager);
        
        $this->assertSame(
            $count,
            $entryService->getTotalEntriesCount()
        );
    }

    public function testShouldGetEntries(){
        $pageSize = 10;
        $currentPage = 1;
        $offset = ($currentPage - 1) * $pageSize;

        $pager = $this->createMock(Pager::class);
        $pager->method('getPageSize')->willReturn($pageSize);
        $pager->method('getCurrentPage')->willReturn($currentPage);
        
        $this->entryManager
            ->method('getEntries')
            ->with($pageSize, $offset)
            ->willReturn([$this->entry]);
        
        $entryService = new EntryService($this->entryManager);
        
        $this->assertSame(
            [$this->entry],
            $entryService->getEntries($pager)
        );
    }


}