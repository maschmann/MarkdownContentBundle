<?php
/*
 * This file is part of the AsmMarkdownContentBundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class CurrentLocaleListener
 *
 * @package Asm\MarkdownContentBundle\EventListener
 * @author Marc Aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\HttpKernel\Event\GetResponseEvent
 */
class CurrentLocaleListener
{
    /**
     * @var EntityLocaleSetter
     */
    private $entityLocaleSetter;

    /**
     * @param EntityLocaleSetter $entityLocaleSetter
     */
    public function __construct(EntityLocaleSetter $entityLocaleSetter)
    {
        $this->entityLocaleSetter = $entityLocaleSetter;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->entityLocaleSetter->setRequest($event->getRequest());
    }
}
