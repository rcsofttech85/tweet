<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 11:26 AM
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{


    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {

        $this->encoder = $encoder;
    }
    /**
     * @Route("/register",name="user_register")
     * @return Response
     */
    public function register(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $hashPassword =  $this->encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hashPassword);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('micropost');
        }

        return $this->render('user/register.html.twig',['form'=>$form->createView()]);

    }

    /**
     *
     * @Route("/micro",name="micropost")
     */
    public function micropost()
    {
        return $this->render('micropost/index.html.twig');
    }
}