<?php

namespace App\Controller\Entrylist;

use Symfony\Component\HttpFoundation\Request;
use App\Security\ActionVoter;

class EditController extends BaseController{

    public function edit(Request $request, $id)
    {
        if(!$this->is_allowed(ActionVoter::EDIT))
            return $this->redirectToRoute('index');

        $entryService = $this->getEntryService();
        $entry = $entryService->getEntry($id);
        
        if($request->isMethod('POST'))
        {
            $type= $entry->getType();

            if('image' == $type)
            {
                $file = $request->files->get('fileDetail');
                
                if(isset($file))
                {
                    $filepath = $this->imageProcessor
                        ->updateImage($file, $entry->getDetail());

                    $entry->setDetail($filepath);
                }
                else
                {
                    $entry->setDetail(ImageTypeProcessor::NULL_IMAGE);
                }
            }
            else
            {
                $entry->setDetail($request->request->get('detail'));
            }
                
                $entry->setTitle($request->request->get('title'));
                $entry->setIsApproved(false);
            
            try
            {
                $entryService = $this->getEntryService();
                $entryService->addEntry($entry);

                $this->addFlash("success", "Entry has been successfully added");

            }catch(\Exception $e)
            {
                $this->addFlash("error", $e->getMessage());
            }

            return $this->redirectToRoute('entry_list');
        }

        return $this->render('list/edit.html.twig',[ 'entry' => $entry]);
    }
    
}