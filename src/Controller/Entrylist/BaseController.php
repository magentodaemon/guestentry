<?php

namespace App\Controller\Entrylist;

use App\Services\EntryServiceInterface;
use App\Utils\ImageTypeProcessorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @codeCoverageIgnore
 */
class BaseController extends Controller
{
    /**
     * $session
     *
     * @var SessionInterface
     */
    protected $session;

    /**
     * $imageProcessor
     *
     * @var ImageTypeProcessorInterface
     */
    protected $imageProcessor;

    /**
     * __construct
     *
     * @param ImageTypeProcessorInterface $imageProcessor
     * @param SessionInterface $session
     * @return void
     */
    public function __construct(ImageTypeProcessorInterface $imageProcessor,SessionInterface $session)
    {
        $this->session = $session;
        $this->imageProcessor = $imageProcessor;
    }

    protected function is_allowed(string $actionType): bool
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