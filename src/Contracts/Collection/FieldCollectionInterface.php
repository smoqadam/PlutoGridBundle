<?php

namespace Pluto\GridBundle\Contracts\Collection;

use Pluto\GridBundle\Contracts\Field\FieldInterface;

interface FieldCollectionInterface extends CollectionInterface
{
    public function add( FieldInterface $row);
}
