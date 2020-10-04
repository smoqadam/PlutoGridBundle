<?php

namespace Pluto\GridBundle\Contracts\Entity;

use Pluto\GridBundle\Contracts\Collection\FieldCollectionInterface;

interface HeaderInterface
{
    public function getFields(): FieldCollectionInterface;

    public function setFields(FieldCollectionInterface $fieldCollection);
}
