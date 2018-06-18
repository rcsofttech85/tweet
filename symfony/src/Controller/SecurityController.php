<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 12:12 PM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login",name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        return $this->render('security/login.html.twig',[
            'last_username'=>$authenticationUtils->getLastUsername(),
            'error'=> $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout",name="security_logout")
     */
    public function logout()
    {

    }
}