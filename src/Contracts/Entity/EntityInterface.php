<?php

namespace Pluto\GridBundle\Contracts\Entity;
use Pluto\GridBundle\Contracts\Collection\FieldCollectionInterface;

interface EntityInterface
{
    public function getFields():FieldCollectionInterface;

    public function setFields(FieldCollectionInterface $fieldCollection);
}