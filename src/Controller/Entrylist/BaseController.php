<?php

namespace App\Controller\Entrylist;

use App\Services\EntryServiceInterface;
use App\Utils\ImageTypeProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @codeCoverageIgnore
 */
class BaseController extends Controller
{
    protected $session;

    protected $imageProcessor;

    public function __construct(ImageTypeProcessor $imageProcessor,SessionInterface $session)
    {
        $this->session = $session;
        $this->imageProcessor = $imageProcessor;
    }

    protected function is_allowed($actionType)
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

    protected function getEntryService(): EntryServiceInterface
    {
        return $this->container->get('entry_service');
    }

}