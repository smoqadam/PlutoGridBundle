<?php

namespace Pluto\GridBundle\Grid;

use Pluto\GridBundle\Contracts\Grid\GridConfiguratorInterface;
use Pluto\GridBundle\Contracts\Grid\Searchable;

abstract class BaseGridConfigurator implements GridConfiguratorInterface, Searchable
{
    private int $perPage = 10;

    private string $tableCssClass = 'table table-hover';

    private string $headerCssClass = 'header';

    private string $searchTemplate = '@PlutoGrid/includes/search.html.twig' ;

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getTableCssClass(): string
    {
        return $this->tableCssClass;
    }

    public function getHeaderCssClass(): string
    {
        return $this->headerCssClass;
    }

    public function getColumns(): array
    {
        return [];
    }

    public function getSearchTemplate(): string
    {
        return $this->searchTemplate;
    }
}
