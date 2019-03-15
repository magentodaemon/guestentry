<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @codeCoverageIgnore
 */
class LoginController extends Controller
{
    const ADMIN_PASS = 'admin';

    public function login(SessionInterface $session, Request $request)
    {
        if ($request->isMethod('POST')) {
            $userType = $request->request->get('userType');
            $password = $request->request->get('password');

            if ('admin' == $userType) {
                if (self::ADMIN_PASS == $password) {
                    $session->set('userType', $userType);
                } else {
                    $this->addFlash('error', 'Admin password is incorrect');

                    return $this->redirectToRoute('index');
                }
            } else {
                $session->set('userType', $userType);
            }

            return $this->redirectToRoute('entry_list');
        }

        return $this->render('index/login.html.twig', []);
    }
}
