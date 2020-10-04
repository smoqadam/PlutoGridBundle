<?php

namespace Pluto\GridBundle\Collection;

use Exception;
use Pluto\GridBundle\Contracts\Collection\EntityCollectionInterface;
use Pluto\GridBundle\Contracts\Entity\EntityInterface;
use Traversable;

class EntityCollection implements EntityCollectionInterface
{

    private array $entities = [];

    public function getIterator()
    {
        return new \ArrayIterator($this->entities);
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

    public function add(EntityInterface $entity)
    {
        $this->entities[] = $entity;
    }
}