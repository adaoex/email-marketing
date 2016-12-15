<?php
declare (strict_types = 1);
namespace EmailMarketing\Infrastructure\Service;

use EmailMarketing\Domain\Entity\Campanha;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use EmailMarketing\Domain\Service\CampanhaEmailSenderInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaEmailSender implements CampanhaEmailSenderInterface
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
    
    public function setCampanha(Campanha $campanha): CampanhaEmailSender
    {
        $this->campanha = $campanha;
        return $this;
    }
    
    public function send()
    {
        $this->createCampanha();
        $tags = $this->campanha->getTags()->toArray();
        $batchMessage = $this->getBatchMessage();
        foreach ($tags as $tag) {
            $batchMessage->addTag($tag->getNome());
        }
        
        $contatos = $this->repository->findByTags($tags);
        foreach ($contatos as $contato) {
            $nome = (!$contato->getNome() or $contato->getNome() =='')
                    ? $contato->getEmail() : $contato->getNome();
            $batchMessage->addToRecipient(
                    $contato->getEmail(), 
                    ['full_name' => $nome]
                );
        }
        
        $batchMessage->finalize();
    }

    protected function getBatchMessage()
    {
        $domain = $this->mailgunConfig['domain'];
        $batchMessage = $this->mailgun->BatchMessage($domain);
        $batchMessage->addCampaignId("campanha_{$this->campanha->getId()}");
        $batchMessage->setFromAddress("adao@adao.eti.br", ["full_name"=>"Adão FC Gonçalves"]);
        $batchMessage->setSubject($this->campanha->getAssunto());
        $batchMessage->setHtmlBody($this->getHtmlBody());
        return $batchMessage;
    }
    
    protected function getHtmlBody()
    {
        $params = [
            'content' => $this->campanha->getTemplate()
        ];
        return $this->templateRender->render('app::campanha/_campanha_template', $params);
    }
    
    protected function createCampanha()
    {
        $domain = $this->mailgunConfig['domain'];
        
        try {
            $this->mailgun->get("$domain/campaigns/campanha_{$this->campanha->getId()}");    
        } catch (\Mailgun\Connection\Exceptions\MissingEndpoint $exc) {
            $postData = [
                'id' => "campanha_{$this->campanha->getId()}",
                'name' => $this->campanha->getNome(),
            ];
            $this->mailgun->post("$domain/campaigns", $postData);
        }

    }
    
}
