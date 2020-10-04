<?php

namespace Pluto\GridBundle\Contracts\Grid;

use Doctrine\ORM\QueryBuilder;

interface GridConfiguratorInterface
{
    public function getEntity();

    public function getColumns(): array;

    public function getQueryBuilder(): QueryBuilder;

    public function getTableCssClass(): string;

    public function getHeaderCssClass(): string;

    public function getSearchTemplate(): string;
}
