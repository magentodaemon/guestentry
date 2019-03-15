<?php

namespace App\Controller\Entrylist;

use App\Security\ActionVoter;

/**
 * @codeCoverageIgnore
 */
class ApproveController extends BaseController{

    public function approve($id)
    {
        if(!$this->is_allowed(ActionVoter::DELETE))
            return $this->redirectToRoute('index');
        
        $entryService = $this->getEntryService();

        try
        {
            $entryService->approveEntry($id);
            $this->addFlash("success", "Entry has been successfully Approved");
        }
        catch(\Exception $e)
        {
            $this->addFlash("error", $e->getMessage());
        }

        return $this->redirectToRoute('entry_list');
    }
    
}