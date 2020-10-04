<?php

namespace Pluto\GridBundle\Entity;

use Pluto\GridBundle\Contracts\Collection\FieldCollectionInterface;
use Pluto\GridBundle\Contracts\Entity\HeaderInterface;

class Header implements HeaderInterface
{
    private FieldCollectionInterface $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function getFields(): FieldCollectionInterface
    {
        return $this->fields;
    }

    public function setFields(FieldCollectionInterface $fieldCollection)
    {
        $this->fields = $fieldCollection;
    }
}
