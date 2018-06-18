<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 12:54 PM
 */

namespace App\EventSubscriber;


use App\Event\RegisterEvent;
use App\Mailer\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegisterSubscriber implements EventSubscriberInterface
{

    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer)
    {

        $this->mailer = $mailer;
    }
    public static function getSubscribedEvents()
    {
        return [
            RegisterEvent::REGISTER_EVENT => 'onRegisterSendConfirmationToken'
        ];
    }

    public function onRegisterSendConfirmationToken(RegisterEvent $event)
    {
       $this->mailer->sendEmail($event->getUser());
    }
}