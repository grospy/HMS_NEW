<?php


namespace OpenEMR\Sample\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class SampleSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            SampleEvent::NAME => 'onSampleEvent',
        ];
    }

    public function onSampleEvent(Event $event)
    {
        print("You've been notified of an event!");
    }
}
