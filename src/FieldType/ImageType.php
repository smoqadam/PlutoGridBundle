<?php

namespace Pluto\GridBundle\FieldType;

use Pluto\GridBundle\Contracts\Field\FieldInterface;

class ImageType implements FieldInterface
{
    use FieldTrait;

    public static function new($field, ?string $template = null): self
    {
        return (new self())
            ->setField($field)
            ->setValue(null)
            ->setTemplate($template ?? '@PlutoGrid/field/image.html.twig')
        ;
    }
}
