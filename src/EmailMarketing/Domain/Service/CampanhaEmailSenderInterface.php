<?php
declare (strict_types = 1);
namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\Campanha;

interface CampanhaEmailSenderInterface extends EmailServiceInterface
{
    public function setCampanha( Campanha $campanha );
}
