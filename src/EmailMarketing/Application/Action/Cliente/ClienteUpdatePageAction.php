<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Domain\Entity\Endereco;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Persistence\EnderecoRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ClienteUpdatePageAction
{

    private $template;
    
    private $repository;
    
    private $repositoryEndereco;

    private $router;
     
    public function __construct(
            ClienteRepositoryInterface $repository,
            EnderecoRepositoryInterface $repositoryEndereco,
            Template\TemplateRendererInterface $template,
            RouterInterface $router
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->repositoryEndereco = $repositoryEndereco;
        $this->router = $router;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ) {
        
        $flash = $request->getAttribute('flash');
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        
        if ( $request->getMethod() == "PUT" ){
            $data = $request->getParsedBody();
            
            $entity->setNome($data['nome'])
                    ->setCpf($data['cpf'])
                    ->setEmail($data['email']);
            
            foreach ($data['logradouro'] as $k => $logradouro){
                if (strlen($logradouro) > 0 ){
                    if ( key_exists('endereco_id', $data) && is_numeric( $data['endereco_id'][$k]) ){
                        $endereco = $this->repositoryEndereco->find($data['endereco_id'][$k]);
                    }
                    if ( ! $endereco instanceof Endereco) {
                        $endereco = new Endereco();    
                    }
                    $endereco->setLogradouro($logradouro)
                            ->setCidade($data['cidade'][$k])
                            ->setEstado($data['estado'][$k])
                            ->setCep($data['cep'][$k])
                            ->setCliente($entity);
                    $entity->addEndereco($endereco);
                }
            }
            
            $this->repository->update($entity);
           
            $flash->setMessage('success', "Cliente editado com sucesso");
            $uri = $this->router->generateUri('cliente.list');
            return new RedirectResponse( $uri );
        }

        return new HtmlResponse(
            $this->template->render('app::cliente/update', [
                'cliente' => $entity,
            ])
        );
    }
}
