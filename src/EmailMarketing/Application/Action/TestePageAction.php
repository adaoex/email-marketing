<?php

namespace EmailMarketing\Application\Action;

use EmailMarketing\Domain\Entity\Cliente;
use EmailMarketing\Domain\Entity\Endereco;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestePageAction
{

    private $template;
    
    private $repository;

    public function __construct(
            ClienteRepositoryInterface $repository,
            Template\TemplateRendererInterface $template = null
    ) {
        $this->template = $template;
        $this->repository = $repository;
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
        
        $this->repository->create($cliente);
        #$this->repository->create($endereco1);
        #$this->repository->create($endereco2);
        
        
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
        
        $this->repository->create($cliente2);
        #$this->repository->create($endereco3);
        #$this->repository->create($endereco4);
        
        $clientes = $this->repository->findAll();

        return new HtmlResponse(
            $this->template->render('app::teste', [
                'app' => 'Minha primeira aplicação',
                'clientes' => $clientes,
            ]
        ));
    }
}
