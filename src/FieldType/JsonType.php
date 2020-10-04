<?php

namespace Pluto\GridBundle\FieldType;

use Pluto\GridBundle\Contracts\Field\FieldInterface;

class JsonType implements FieldInterface
{
    use FieldTrait;

    public static function new($field, ?string $template = null): self
    {
        return (new self())
            ->setField($field)
            ->setValue(null)
            ->setTemplate($template ?? '@PlutoGrid/field/json.html.twig')
        ;
    }

    public function setValue($value)
    {
        $this->value = json_encode($value);

        return $this;
    }
}
