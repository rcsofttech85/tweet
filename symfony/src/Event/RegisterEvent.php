<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 18/6/18
 * Time: 12:47 PM
 */

namespace App\Event;


use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class RegisterEvent extends Event
{
    public const REGISTER_EVENT = 'register.event';
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function getUser()
    {

        return $this->user;

    }

}