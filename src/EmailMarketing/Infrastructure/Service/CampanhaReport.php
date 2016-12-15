<?php
declare (strict_types = 1);
namespace EmailMarketing\Infrastructure\Service;

use EmailMarketing\Domain\Entity\Campanha;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use EmailMarketing\Domain\Service\CampanhaReportInterface;
use Mailgun\Mailgun;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaReport implements CampanhaReportInterface
{

    /**
     * @var ContatoRepositoryInterface
     */
    private $repository;

    /**
     * @var Mailgun
     */
    private $mailgun;

    /**
     * @var Campanha 
     */
    private $campanha;

    private $templateRender;
    
    private $mailgunConfig;
    
    public function __construct(
            TemplateRendererInterface $templateRender,
            Mailgun $mailgun,
            array $mailgunConfig,
            ContatoRepositoryInterface $repository
    ){
        $this->mailgunConfig = $mailgunConfig;
        $this->templateRender = $templateRender;
        $this->mailgun = $mailgun;
        $this->repository = $repository;
    }
    
    public function setCampanha(Campanha $campanha): CampanhaReport
    {
        $this->campanha = $campanha;
        return $this;
    }

    public function render(): ResponseInterface
    {
        return new HtmlResponse($this->templateRender->render('app::campanha/report', [
            'campaign_data' => $this->getCampaignData(),
            'campaign' => $this->campanha,
            'customers_count' => $this->getCountContatos(),
            'opened_distinct_count' => $this->getCountOpenedDistinct()
        ]));
    }

    /**
     * API Mailgun - https://documentation.mailgun.com/api-campaigns.html#campaigns
     * @return object 
     */
    protected function getCampaignData()
    {
        $domain = $this->mailgunConfig['domain'];
        $response = $this->mailgun->get("$domain/campaigns/campanha_{$this->campanha->getId()}");
        return $response->http_response_body;
    }
    
    /**
     * API Mailgun - https://documentation.mailgun.com/api-campaigns.html#opens
     * @return int quantidade total de aberturas 
     */
    protected function getCountOpenedDistinct()
    {
        $domain = $this->mailgunConfig['domain'];
        $response = $this->mailgun->get("$domain/campaigns/campanha_{$this->campanha->getId()}/opens", 
                ['groupby' => 'recipient', 'count' => true]);
        #var_dump($response); die;
        return $response->http_response_body->count;
    }
    
    protected function getCountContatos()
    {
        $tags = $this->campanha->getTags()->toArray();
        $contatos = $this->repository->findByTags($tags);
        return count($contatos);
    }
    
}
