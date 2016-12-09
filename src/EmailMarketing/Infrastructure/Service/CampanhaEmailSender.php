<?php
declare (strict_types = 1);
namespace EmailMarketing\Infrastructure\Service;

use EmailMarketing\Domain\Entity\Campanha;
use EmailMarketing\Domain\Service\CampanhaEmailSenderInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaEmailSender implements CampanhaEmailSenderInterface
{

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
            array $mailgunConfig
    ){
        $this->mailgunConfig = $mailgunConfig;
        $this->templateRender = $templateRender;
        $this->mailgun = $mailgun;
    }
    
    public function setCampanha(Campanha $campanha): CampanhaEmailSender
    {
        $this->campanha = $campanha;
        return $this;
    }
    
    public function send()
    {
        $tags = $this->campanha->getTags()->toArray();
        $batchMessage = $this->getBatchMessage();
        foreach ($tags as $tag) {
            $batchMessage->addTag($tag->getNome());
            $contatos = $tag->getContatos()->toArray();
            foreach ($contatos as $contato) {
                $nome = (!$contato->getNome() or $contato->getNome() =='')
                        ? $contato->getEmail() : $contato->getNome();
                $batchMessage->addToRecipient(
                        $contato->getEmail(), 
                        [
                            'full_name' => $nome
                        ]
                    );
            }
        }
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
    
}
