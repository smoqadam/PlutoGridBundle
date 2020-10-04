<?php

namespace Pluto\GridBundle\Contracts\Collection;

use Pluto\GridBundle\Contracts\Entity\EntityInterface;

interface EntityCollectionInterface extends CollectionInterface
{
    public function add(EntityInterface $entity);
}
