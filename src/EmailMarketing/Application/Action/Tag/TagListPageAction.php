<?php

namespace EmailMarketing\Application\Action\Tag;

use EmailMarketing\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TagListPageAction
{

    /**
     * @var FindByNameCriteriaInterface
     */
    private $criteria;
    private $template;
    
    private $repository;

    public function __construct(
        TagRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        FindByNameCriteriaInterface $criteria
    ){
        $this->template = $template;
        $this->repository = $repository;
        $this->criteria = $criteria;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ){
        $url_query = $request->getQueryParams();
        $flash = $request->getAttribute('flash');
        if (array_key_exists('p',$url_query) ){
            $this->criteria->setNome( $url_query['p'] );
            $this->repository->add($this->criteria);
            $tags = $this->repository->findWithCriteria();
        } else{
            $tags = $this->repository->findAll();
        }
        $message = $flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS);
        return new HtmlResponse(
            $this->template->render('app::tag/list', [
                'tags' => $tags,
                'message' => $message,
            ]
        ));
    }
}
