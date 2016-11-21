<?php
declare (strict_types = 1);
namespace EmailMarketing\Domain\Service;

interface FlashMessageInterface
{

    const MESSAGE_SUCCESS   = 0;
    const MESSAGE_ERROR     = 1;
    const MESSAGE_WARNING   = 2;
    const MESSAGE_INFO      = 3;
    
    public function setNamespace(string $name);

    public function setMessage($key, string $value);

    public function getMessage($key);
}
