<?php

namespace App\Controller\Entrylist;

use App\Security\ActionVoter;

/**
 * @codeCoverageIgnore
 */
class RevokeController extends BaseController{

    public function revoke($id)
    {
        if(!$this->is_allowed(ActionVoter::DELETE))
            return $this->redirectToRoute('index');
        
        $entryService = $this->getEntryService();

        try
        {
            $entryService->revokeEntry($id);
            $this->addFlash("success", "Entry has been successfully revoked");
        }
        catch(\Exception $e)
        {
            $this->addFlash("error", $e->getMessage());
        }

        return $this->redirectToRoute('entry_list');
    }
    
}