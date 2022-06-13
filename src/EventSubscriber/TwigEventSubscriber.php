<?php

namespace App\EventSubscriber;

use App\Repository\ConferenceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $conferenceRepository;

    public function __construct(ConferenceRepository $conferenceRepository, Environment $twig) {
        $this->conferenceRepository = $conferenceRepository;
        $this->twig = $twig;
    }
    public function onControllerEvent(ControllerEvent $event)
    {
        $this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            'Symfony\Component\HttpKernel\Event\ControllerEvent' => 'onControllerEvent',
        ];
    }
}
