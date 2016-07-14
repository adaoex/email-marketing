<?php

namespace EmailMarketing\Domain\Service;

interface FlashMessageInterface
{

    public function setNamespace($name);

    public function setMessage($key, $value);

    public function getMessage($key);
}
