<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 4:25 PM
 */

namespace App\Mailer;


use App\Entity\User;

class Mailer
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig_Environment
     */
    private $environment;
    /**
     * @var string
     */
    private $mailFrom;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $environment, string $mailFrom)
    {

        $this->mailer = $mailer;
        $this->environment = $environment;
        $this->mailFrom = $mailFrom;
    }

    public function sendEmail(User $user)
    {
        $body = $this->environment->render('mail/confirmation.html.twig',
            ['user' => $user]);
        $message = (new \Swift_Message())->setSubject("welcome to our app")
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}