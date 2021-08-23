<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/sign_in", name="sign_in")
     */
    public function login(Request $request, AuthenticationUtils $utils): Response

    {
            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
                    return $this->redirectToRoute('profil');
                } else if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                    return $this->redirectToRoute('news');
                }
                else {
                    return $this->redirectToRoute('logout');
                }
                }

$user=$this->getUser();

            $error = $utils->getLastAuthenticationError();
            $lastUsername = $utils->getLastUsername();
            return $this->render('front/sign_in.html.twig', [
                'error' => $error,  'user' => $user,
                'last_username' => $lastUsername,


            ]);

        }
    /**
     * @Route("/sign_in2", name="sign_in2")
     */
    public function login2(Request $request, AuthenticationUtils $utils): Response

    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('home');


            }

        }


            $error = $utils->getLastAuthenticationError();
            $lastUsername = $utils->getLastUsername();
            return $this->render('back/sign_up2.html.twig', [
                'error' => $error,
                'last_username' => $lastUsername,


            ]);

        }


    /**
     * @Route("/front/logout", name="logout")
     */
    public function logout()
    {


    }
}
