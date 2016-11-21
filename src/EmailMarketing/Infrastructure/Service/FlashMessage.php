<?php

namespace EmailMarketing\Infrastructure\Service;

use EmailMarketing\Domain\Service\FlashMessageInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessage implements FlashMessageInterface
{

    /**
     * @var FlashMessenger 
     */
    private $flashMessage;

    public function __construct(FlashMessenger $flashmessage)
    {
        $this->flashMessage = $flashmessage;
    }
    
    public function setNamespace($name = __NAMESPACE__ )
    {
        $this->flashMessage->setNamespace($name);
        return $this;
    }
        
    public function setMessage($key, $value)
    {
        switch ($key) {
            case self::MESSAGE_SUCCESS:
                $this->flashMessage->addSuccessMessage($value);
                break;
            case self::MESSAGE_ERROR:
                $this->flashMessage->addErrorMessage($value);
                break;
            case self::MESSAGE_INFO:
                $this->flashMessage->addInfoMessage($value);
                break;
            case self::MESSAGE_WARNING:
                $this->flashMessage->addWarningMessage($value);
                break;
            default:
                $this->flashMessage->addMessage($value);
                break;
        }
        return $this;
    }

    public function getMessage($key)
    {
        $result = null;
        switch ($key) {
            case self::MESSAGE_SUCCESS:
                $result = $this->flashMessage->getCurrentSuccessMessages();
                break;
            case self::MESSAGE_ERROR:
                $result = $this->flashMessage->getCurrentErrorMessages();
                break;
            case self::MESSAGE_INFO:
                $result = $this->flashMessage->getCurrentInfoMessages();
                break;
            case self::MESSAGE_WARNING:
                $result = $this->flashMessage->getCurrentWarningMessages();
                break;
            default:
                $result = $this->flashMessage->getCurrentMessages();
                break;
        }
        return count($result) ? $result[0] : null;
    }

}
