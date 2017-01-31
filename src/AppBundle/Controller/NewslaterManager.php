<?php

namespace AppBundle\Newsletter;

use Symfony\Component\Templating\EngineInterface;
use \Swift_Mailer\Mailer;

class NewsletterManager
{
    protected $mailer;
    protected $server;

    protected $templating;

    // Constructor injection (required dependency)
    public function __construct(Mailer $mailer, Other $other = null) // Other = optionl dependency
    {
        $this->mailer = $mailer;
    }

    // Setter injection (optional dependency)
    public function setServer(Server $server)
    {
        $this->server = $server;
    }

}
