<?php

namespace EmailMarketing\Infrastructure\Service;

use Aura\Session\Session;
use EmailMarketing\Domain\Service\FlashMessageInterface;

class FlashMessage implements FlashMessageInterface
{

    /**
     * @var Session Sessão
     */
    private $session;

    /**
     * @var \Aura\Session\Segment 
     */
    private $segment;

    public function __construct(Session $session)
    {
        $this->session = $session;
        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }

    public function setNamespace($name = __NAMESPACE__ )
    {
        $this->segment = $this->session->getSegment($name);
        return $this;
    }
        
    public function setMessage($key, $value)
    {
        if (!$this->segment) {
            $this->setNamespace();
        }
        $this->segment->setFlash($key, $value);
        return $this;
    }

    public function getMessage($key)
    {
        if (!$this->segment) {
            $this->setNamespace();
        }
        return $this->segment->getFlash($key);
    }

}
