<?php

namespace Pluto\GridBundle\Factory;

use Pluto\GridBundle\Contracts\Field\FieldInterface;
use Pluto\GridBundle\FieldType\FieldType;
use Pluto\GridBundle\FieldType\JsonType;

class FieldFactory
{
    const IMAGE_FIELDS = [
        'image', 'cover', 'avatar',
    ];

    const TEXT_FIELDS = [
        'description', 'desc', 'text',
    ];

    public static function make($type, $field): FieldInterface
    {
        switch ($type) {
            case 'boolean':
            case 'string':
            case 'integer':
                return FieldType::new($field);
            case 'json':
                return JsonType::new($field);
            default:
                return FieldType::new($field);
        }
    }
}
