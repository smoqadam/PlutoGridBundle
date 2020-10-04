<?php

namespace Pluto\GridBundle\Builder;

use Doctrine\ORM\EntityManagerInterface;
use Pluto\GridBundle\Contracts\Grid\GridConfiguratorInterface;
use Pluto\GridBundle\Factory\FieldFactory;
use Pluto\GridBundle\Field;

/// 1. extract fields from the given entity
/// 2. build an array of fields with type, title, colName, fieldName
/// 3. merge with user given columns

class FieldBuilder
{
    private GridConfiguratorInterface $grid;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function setGrid(GridConfiguratorInterface $grid)
    {
        $this->grid = $grid;

        return $this;
    }

    // todo: FieldMappingBuilder class
    public function buildFieldMapping()
    {
        $fields = $this->getAllFields();

        if (!empty($this->grid->getColumns())) {
            $fields = $this->merge($this->grid->getColumns(), $fields);
        }

        return $fields;
//        list($userFields, $allFields) = $this->getCustomFields($allFields);
//        $this->fieldMapping = $allFields;
//        if (!empty($userFields)) {
//            $this->fieldMapping = $userFields;
//        }

        return $this;
    }

    /**
     * @param $meta
     */
    private function getAllFields(): array
    {
        $meta = $this->em->getClassMetadata($this->grid->getEntity());
        $allFields = [];
        foreach ($meta->fieldMappings as $field) {
            $allFields[$field['fieldName']] = (new Field())
                ->setTitle($this->generateTitle($field['columnName']))
                ->setColumnName($field['columnName'])
                ->setType(FieldFactory::make($field['type'], $field['fieldName']))
                ->setFieldName($field['fieldName']);
        }

        return $allFields;
    }

    private function generateTitle($columnName)
    {
        $a = explode('_', $columnName);
        $res = array_map(function ($key) {
            return ucfirst($key);
        }, $a);

        return implode(' ', $res);
    }

    private function merge($userFields, $allFields): array
    {
        $result = [];
        foreach ($userFields as $userField) {
            $result[$userField->getField()] = $allFields[$userField->getField()];
            $result[$userField->getField()]->setType($userField);
        }

        return $result;
    }
}
