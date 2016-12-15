<?php
declare (strict_types = 1);
namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\Campanha;
use Psr\Http\Message\ResponseInterface;

interface CampanhaReportInterface
{
    public function setCampanha( Campanha $campanha );
    public function render() : ResponseInterface;
}
