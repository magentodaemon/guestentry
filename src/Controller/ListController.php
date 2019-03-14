<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Service\EntryService;
use App\Security\ActionVoter;
use App\Utils\Pager;
use App\Utils\ImageTypeProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ListController extends Controller
{
    private $session;

    private $imageProcessor;

    public function __construct(ImageTypeProcessor $imageProcessor,SessionInterface $session)
    {
        $this->session = $session;
        $this->imageProcessor = $imageProcessor;
    }

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

    public function add(Request $request)
    {
        if(!$this->is_allowed(ActionVoter::ADD))
            return $this->redirectToRoute('index');

        if($request->isMethod('POST'))
        {
            $entry = new Entry();
            $entry->setTitle($request->request->get('title'));

            $type= $request->request->get('entryType');

            $entry->setType($type);

            if('image' == $type)
            {
                $file = $request->files->get('fileDetail');
                
                if(isset($file))
                {
                    $filepath = $this->imageProcessor->updateImage($file);
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

        return $this->render('list/add.html.twig',[]);
    }

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

    private function is_allowed($actionType)
    {
        try
        {
            $this->denyAccessUnlessGranted($actionType, $this->session);
        }catch(\Exception $e)
        {
            $this->addFlash("error", $e->getMessage());
            return false;
        }

        return true;
    }   

    private function getEntryService(){
        return $this->container->get('entry_service');
    }
}