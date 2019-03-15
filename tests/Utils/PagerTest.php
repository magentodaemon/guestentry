<?php

use PHPUnit\Framework\TestCase;
use App\Utils\Pager;
use App\Utils\PagerInterface;

class PagerTest extends TestCase
{
    const DEFAULT_SIZE = 10;
    const DEFAULT_CURRENT_PAGE = 1;

    public function testShouldbeAnInstanceofPager()
    {
        $this->assertInstanceOf(PagerInterface::class, new Pager());
    }

    public function testShouldHaveADefaultSize()
    {
        $pager = new Pager();

        $this->assertSame(
            self::DEFAULT_SIZE,
            $pager->getPageSize()
        );
    }

    public function testShouldHaveADefaultCurrentPage()
    {
        $pager = new Pager();

        $this->assertSame(
            self::DEFAULT_CURRENT_PAGE,
            $pager->getCurrentPage()
        );
    }

    public function testShouldRenderPaginationValues()
    {
        $pager = new Pager();

        $pager->setCurrentPage(2);
        $pager->renderer(35);

        $this->assertSame(
            3,
            $pager->getNextPage()
        );

        $this->assertSame(
            1,
            $pager->getPreviousPage()
        );

        $this->assertSame(
            [2, 3, 4],
            $pager->getDisplayNumbers()
        );

        $this->assertSame(
            2,
            $pager->getCurrentPage()
        );
    }

    public function testShouldNotReturnPreviousPageIfCurrentPageIsFirst()
    {
        $pager = new Pager();

        $pager->setCurrentPage(1);
        $pager->renderer(25);

        $this->assertSame(
            false,
            $pager->getPreviousPage()
        );

        $this->assertSame(
            [1, 2, 3],
            $pager->getDisplayNumbers()
        );
    }

    public function testShouldNotReturnNextPageIfCurrentPageIsLast()
    {
        $pager = new Pager();

        $pager->setCurrentPage(3);
        $pager->renderer(25);

        $this->assertSame(
            false,
            $pager->getNextPage()
        );
    }

    public function testShouldNotSetCurrentPageLessThanOne()
    {
        $pager = new Pager();

        $pager->setCurrentPage(0);
        $pager->renderer(25);

        $this->assertSame(
            1,
            $pager->getCurrentPage()
        );
    }
}
