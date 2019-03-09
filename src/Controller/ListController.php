<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Service\EntryService;
use App\Utils\Pager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends Controller
{

    public function list($page)
    {
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

    public function add(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $entry = new Entry();
            $entry->setTitle($request->request->get('title'));
            $entry->setType($request->request->get('entryType'));
            $entry->setDetail($request->request->get('detail'));
            
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

    public function getEntryService(){
        return $this->container->get('entry_service');
    }
}