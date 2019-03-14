<?php

namespace App\Controller\Entrylist;

use App\Security\ActionVoter;

class DeleteController extends BaseController{

    public function delete($id)
    {
        if(!$this->is_allowed(ActionVoter::DELETE))
            return $this->redirectToRoute('index');
        
        $entryService = $this->getEntryService();

        try
        {
            $entryService->deleteEntry($id);
            $this->addFlash("success", "Entry has been successfully deleted");
        }
        catch(\Exception $e)
        {
            $this->addFlash("error", $e->getMessage());
        }

        return $this->redirectToRoute('entry_list');
    }
    
}