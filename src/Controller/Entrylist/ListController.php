<?php

namespace App\Controller\Entrylist;

use App\Security\ActionVoter;
use App\Utils\Pager;

/**
 * @codeCoverageIgnore
 */
class ListController extends BaseController{

    public function list($page)
    {
        if(!$this->is_allowed(ActionVoter::LIST))
            return $this->redirectToRoute('index');
        
        $pager = new Pager();
        $pager->setCurrentPage($page);

        $entryService = $this->getEntryService();
        $entries = $entryService->getEntries($pager);
        $count = $entryService->getTotalEntriesCount();

        $pager->renderer($count);

        return $this->render(
            'list/list.html.twig', 
            [
                'entries' => $entries,
                'pager' => $pager
            ]);
    }
    
}