<?php

namespace Pluto\GridBundle\Entity;

use Doctrine\ORM\QueryBuilder;
use Pluto\GridBundle\Contracts\Collection\EntityCollectionInterface;
use Pluto\GridBundle\Contracts\Grid\PaginatorInterface;

class Paginator implements PaginatorInterface
{
    private $pageSize;

    private $currentPage;

    private $pages;

    private QueryBuilder $queryBuilder;

    private EntityCollectionInterface $entityCollection;

    private string $template = '@PlutoGrid/includes/pages.html.twig';

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param mixed $pageSize
     */
    public function setPageSize($pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    /**
     * @return mixed
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param mixed $currentPage
     */
    public function setCurrentPage($currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return mixed
     */
    public function getPages(): array
    {
        return range(1, $this->pages);
    }

    /**
     * @param mixed $pages
     */
    public function setPages($pages): void
    {
        $this->pages = $pages;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder): void
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function paginate(QueryBuilder $queryBuilder): EntityCollectionInterface
    {
    }

    public function getTemplate()
    {
        return $this->template;
    }
}
