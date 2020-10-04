<?php

namespace Pluto\GridBundle\Contracts\Grid;

use Doctrine\ORM\QueryBuilder;

interface Searchable
{
    public function getQueryBuilder(): QueryBuilder;

    public function getSearchTemplate(): string;
}
