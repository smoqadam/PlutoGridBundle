<?php

namespace Pluto\GridBundle\Contracts\Field;

interface FieldInterface
{
    public function getValue();

    public function setValue($value);
}
