<?php

namespace Pluto\GridBundle\Collection;

use Pluto\GridBundle\Contracts\Collection\FieldCollectionInterface;
use Pluto\GridBundle\Contracts\Field\FieldInterface;

class FieldCollection implements FieldCollectionInterface
{
    private array $fields;

    public function getIterator()
    {
        return new \ArrayIterator($this->fields);
    }

    public function offsetExists($offset)
    {
        return isset($this->fields[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->fields[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->fields[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->fields[$offset]);
    }

    public function count()
    {
        return count($this->fields);
    }

    public function add(FieldInterface $field)
    {
        $this->fields[] = $field;
    }

    public function get($field): FieldInterface
    {
        return $this->fields[$field];
    }
}
