<?php

namespace App\Controller\Entrylist;

use App\Security\ActionVoter;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends BaseController{

    public function view(Request $request, $id)
    {
        if(!$this->is_allowed(ActionVoter::VIEW))
            return $this->redirectToRoute('index');

        $entryService = $this->getEntryService();

        $entry = $entryService->getEntry($id);

        return $this->render(
            'list/view.html.twig', 
            [
                'entry' => $entry
            ]);
    }
    
}