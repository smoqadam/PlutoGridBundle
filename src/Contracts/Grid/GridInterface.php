<?php

namespace Pluto\GridBundle\Contracts\Grid;

use Pluto\GridBundle\Contracts\Collection\EntityCollectionInterface;
use Pluto\GridBundle\Contracts\Entity\HeaderInterface;

interface GridInterface
{
    public function setEntities(EntityCollectionInterface $entityCollection);

    public function getEntities(): EntityCollectionInterface;

    public function getPaginator(): PaginatorInterface;

    public function setPaginator(PaginatorInterface $paginator);

    public function getTemplate(): string;

    public function getSearchTemplate(): string;

    public function setSearchTemplate($template);

    public function setTemplate(string $template);

    public function getHeader(): HeaderInterface;

    public function setHeader(HeaderInterface $header);

    public function render();

    public function getHeaderCssClass(): string;

    public function setHeaderCssClass(string $headerCssClass): void;

    public function setTableCssClass(string $class);

    public function getTableCssClass();
}
