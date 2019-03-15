<?php

namespace App\Controller\Entrylist;

use App\Entity\Entry;
use Symfony\Component\HttpFoundation\Request;
use App\Security\ActionVoter;

/**
 * @codeCoverageIgnore
 */
class AddController extends BaseController
{
    public function add(Request $request)
    {
        if (!$this->is_allowed(ActionVoter::ADD)) {
            return $this->redirectToRoute('index');
        }

        if ($request->isMethod('POST')) {
            $entry = new Entry();
            $entry->setTitle($request->request->get('title'));

            $type = $request->request->get('entryType');

            $entry->setType($type);

            if ('image' == $type) {
                $file = $request->files->get('fileDetail');

                if (isset($file)) {
                    $filepath = $this->imageProcessor->updateImage($file);
                    $entry->setDetail($filepath);
                } else {
                    $entry->setDetail(ImageTypeProcessor::NULL_IMAGE);
                }
            } else {
                $entry->setDetail($request->request->get('detail'));
            }

            try {
                $entryService = $this->getEntryService();
                $entryService->addEntry($entry);

                $this->addFlash('success', 'Entry has been successfully added');
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }

            return $this->redirectToRoute('entry_list');
        }

        return $this->render('list/add.html.twig', []);
    }
}
