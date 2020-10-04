<?php

namespace Pluto\GridBundle\Contracts\Collection;

use Pluto\GridBundle\Grid\Row;

interface RowCollectionInterface extends CollectionInterface
{
    public function add(Row $row);
}
