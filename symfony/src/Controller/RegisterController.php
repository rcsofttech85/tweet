<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 11:26 AM
 */

namespace App\Controller;


use App\Entity\User;
use App\Event\RegisterEvent;
use App\Form\UserType;
use App\Utils\GenerateToken;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{


    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var GenerateToken
     */
    private $generateToken;

    public function __construct(
        UserPasswordEncoderInterface $encoder,
        EventDispatcherInterface $dispatcher,
        GenerateToken $generateToken)
    {

        $this->encoder = $encoder;
        $this->dispatcher = $dispatcher;
        $this->generateToken = $generateToken;
    }

    /**
     * @Route("/register",name="user_register")
     * @return Response
     */
    public function register(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashPassword = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hashPassword);
            $token = $this->generateToken->generate();
            $user->setConfirmationToken($token);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $registerEvent = new RegisterEvent($user);

            $this->dispatcher->dispatch(RegisterEvent::REGISTER_EVENT, $registerEvent);

            return $this->redirectToRoute('micropost');
        }

        return $this->render('user/register.html.twig', ['form' => $form->createView()]);

    }

    /**
     *
     * @Route("/micro",name="micropost")
     */
    public function micropost()
    {
        return $this->render('micropost/index.html.twig');
    }

    /**
     * @Route("/confirm/{confirmationToken}",name="confirm_token")
     */
    public function confirm()
    {

    }
}