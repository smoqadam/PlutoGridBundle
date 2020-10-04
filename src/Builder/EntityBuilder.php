<?php

namespace Pluto\GridBundle\Builder;

use Doctrine\ORM\QueryBuilder;
use Pluto\GridBundle\Collection\EntityCollection;
use Pluto\GridBundle\Collection\FieldCollection;
use Pluto\GridBundle\Contracts\Grid\PaginatorInterface;
use Pluto\GridBundle\Entity\Entity;
use Pluto\GridBundle\Entity\Paginator;

class EntityBuilder
{
    private QueryBuilder $queryBuilder;

    private EntityCollection $collection;
    private $fields;
    private int $limit;
    private $page;
    private PaginatorInterface $paginator;

    /**
     * @var Paginator
     */
    public function __construct(EntityCollection $collection, PaginatorInterface $paginator)
    {
        $this->collection = $collection;
        $this->paginator = $paginator;
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function build()
    {
        $qb = clone $this->queryBuilder;
        $alias = $qb->getRootAliases()[0];
        $count = $qb->select("count($alias.id)")
            ->getQuery()->getSingleScalarResult();

        $page = $this->page;
        $limit = $this->limit;

        $pages = floor($count / $limit);

        $this->paginator->setCurrentPage($page);
        $this->paginator->setPages($pages);
        $this->paginator->setPageSize($limit);

        $rows = $this->queryBuilder
            ->getQuery()
            ->setFirstResult(($page-1) * $limit)
            ->setMaxResults($limit)
            ->getArrayResult();

        foreach ($rows as $row) {
            $fields = new FieldCollection();
            foreach ($this->fields as $fieldName => $fieldType) {
                $v = clone $fieldType->getType()->setValue($row[$fieldType->getFieldName()]);
                $fields->add($v);
            }
            $this->collection->add(new Entity($fields));
        }

        return $this;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    public function getPaginator(): PaginatorInterface
    {
        return $this->paginator;
    }

    public function getEntities(): EntityCollection
    {
        return $this->collection;
    }
}
