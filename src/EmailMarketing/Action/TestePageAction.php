<?php

namespace EmailMarketing\Action;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Entity\Cliente;
use EmailMarketing\Entity\Endereco;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestePageAction
{

    private $template;

    private $entityManager;

    public function __construct(
            EntityManager $entityManager,
            Template\TemplateRendererInterface $template = null
    ) {
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ) {

        $endereco1 = new Endereco();
        $endereco1->setLogradouro("Logradouro, ende 01")
                ->setCidade("Brasília")
                ->setEstado("DF")
                ->setCep("70200200");
        $endereco2 = new Endereco();
        $endereco2->setLogradouro("Logradouro, ende 02")
                ->setCidade("São Paulo")
                ->setEstado("SP")
                ->setCep("70200200");
        
        $cliente = new Cliente();
        $cliente->setNome("Carlos Silva")
                ->setCpf("11122233300")
                ->setEmail("email@site.com")
                ->addEndereco($endereco1)
                ->addEndereco($endereco2);
        
        $endereco1->setCliente($cliente);
        $endereco2->setCliente($cliente);
        
        $this->entityManager->persist($cliente);
        $this->entityManager->persist($endereco1);
        $this->entityManager->persist($endereco2);
        
        
        $endereco3 = new Endereco();
        $endereco3->setLogradouro("Logradouro, endereço 10")
                ->setCidade("Brasília")
                ->setEstado("DF")
                ->setCep("70200200");
        $endereco4 = new Endereco();
        $endereco4->setLogradouro("Logradouro, endereço 09")
                ->setCidade("São Luiz")
                ->setEstado("MA")
                ->setCep("90200200");
        
        $cliente2 = new Cliente();
        $cliente2->setNome("Rosa Maria")
                ->setCpf("11199933300")
                ->setEmail("email@site.com")
                ->addEndereco($endereco3)
                ->addEndereco($endereco4);
        
        $endereco3->setCliente($cliente2);
        $endereco4->setCliente($cliente2);
        
        $this->entityManager->persist($cliente2);
        $this->entityManager->persist($endereco3);
        $this->entityManager->persist($endereco4);
        
        $this->entityManager->flush();

        $clientes = $this->entityManager->getRepository(Cliente::class)->findBy([], ['nome'=>'DESC']);

        return new HtmlResponse(
            $this->template->render('app::teste', [
                'app' => 'Minha primeira aplicação',
                'clientes' => $clientes,
            ]
        ));
    }
}
