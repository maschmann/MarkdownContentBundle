<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\MarkdownContentBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class CurrentLocaleListener
{
    private $entityLocaleSetter;

    public function __construct(EntityLocaleSetter $entityLocaleSetter)
    {
        $this->entityLocaleSetter = $entityLocaleSetter;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->entityLocaleSetter->setRequest($event->getRequest());
    }
}
