<?php

namespace Pluto\GridBundle\Grid;

use Pluto\GridBundle\Contracts\Collection\EntityCollectionInterface;
use Pluto\GridBundle\Contracts\Entity\HeaderInterface;
use Pluto\GridBundle\Contracts\Grid\GridInterface;
use Pluto\GridBundle\Contracts\Grid\PaginatorInterface;

class Grid implements GridInterface
{
    private EntityCollectionInterface $entities;

    private PaginatorInterface $paginator;

    private HeaderInterface $header;

    private string $template = '@PlutoGrid/grid.html.twig';

    private string $searchTemplate = '@PlutoGrid/includes/search.html.twig';

    private string $tableCssClass = 'table';

    private string $headerCssClass = 'table-header';

    public function setEntities(EntityCollectionInterface $entityCollection)
    {
        $this->entities = $entityCollection;
    }

    public function getEntities(): EntityCollectionInterface
    {
        return $this->entities;
    }

    public function getPaginator(): PaginatorInterface
    {
        return $this->paginator;
    }

    public function setPaginator(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function getHeader(): HeaderInterface
    {
        return $this->header;
    }

    public function setHeader(HeaderInterface $header)
    {
        $this->header = $header;
    }

    public function render()
    {
        // TODO: Implement render() method.
    }

    /**
     * @return string
     */
    public function getTableCssClass(): string
    {
        return $this->tableCssClass;
    }

    /**
     * @param string $tableCssClass
     */
    public function setTableCssClass(string $tableCssClass): void
    {
        $this->tableCssClass = $tableCssClass;
    }

    /**
     * @return string
     */
    public function getHeaderCssClass(): string
    {
        return $this->headerCssClass;
    }

    /**
     * @param string $headerCssClass
     */
    public function setHeaderCssClass(string $headerCssClass): void
    {
        $this->headerCssClass = $headerCssClass;
    }

    public function getSearchTemplate(): string
    {
        return $this->searchTemplate;
    }

    public function setSearchTemplate($template)
    {
        $this->searchTemplate = $template;
    }
}
