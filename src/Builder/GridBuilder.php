<?php

namespace Pluto\GridBundle\Builder;

use Doctrine\ORM\Mapping\ClassMetadata;
use Pluto\GridBundle\Collection\FieldCollection;
use Pluto\GridBundle\Contracts\Builder\GridBuilderInterface;
use Pluto\GridBundle\Contracts\Entity\HeaderInterface;
use Pluto\GridBundle\Contracts\Grid\GridConfiguratorInterface;
use Pluto\GridBundle\Contracts\Grid\GridInterface;
use Pluto\GridBundle\Contracts\Grid\Searchable;
use Pluto\GridBundle\Entity\Entity;
use Pluto\GridBundle\Entity\Header;
use Pluto\GridBundle\Field;
use Pluto\GridBundle\FieldType\FieldType;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class GridBuilder implements GridBuilderInterface
{
    private ContainerInterface $container;

    private $em;

    private GridConfiguratorInterface $gridConfig;

    private ?ClassMetadata $metaData;
    /**
     * @var Request
     */
    private RequestStack $request;
    private $fieldMapping;

    private FieldBuilder$fieldBuilder;

    private EntityBuilder $entityBuilder;
    private HeaderInterface $header;

    private GridInterface $grid;

    public function __construct(
        ContainerInterface $container,
        GridInterface $grid,
        RequestStack $request,
        FieldBuilder $fieldBuilder,
        EntityBuilder $entityBuilder
    ) {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.entity_manager');
        $this->grid = $grid;
        $this->request = $request;
        $this->fieldBuilder = $fieldBuilder;
        $this->entityBuilder = $entityBuilder;
    }

    public function setGridConfig(GridConfiguratorInterface $grid)
    {
        $this->gridConfig = $grid;

        return $this;
    }

    /**
     * Receive a GridConfigInterface object and build a GridInterface.
     *
     * 1. Build Columns
     * 2. Build Rows/Entities
     * 3.
     */
    public function build(GridConfiguratorInterface $grid): GridInterface
    {
        $this->setGridConfig($grid);

        /// Build field mappings
        $this->buildFieldMapping();
        $this->grid->setHeader($this->buildHeader());

        $this->grid->setSearchTemplate($grid->getSearchTemplate());

        /// 2. Query the entity and build entities/rows
        $entityBuilder = $this->buildEntities();

        $this->grid->setEntities($entityBuilder->getEntities());
        $this->grid->setPaginator($entityBuilder->getPaginator());

        $this->grid->setHeaderCssClass($grid->getHeaderCssClass());
        $this->grid->setTableCssClass($grid->getTableCssClass());

        return $this->grid;
    }

    private function buildHeader(): HeaderInterface
    {
        $fieldMappings = $this->getFieldMapping();

        //todo: change this
        $fieldCollection = new FieldCollection();

        /** @var Field $field */
        foreach ($fieldMappings as $fieldName => $field) {
            $fieldCollection->add(FieldType::new($field->getFieldName())->setValue($field->getTitle()));
        }

        return new Header($fieldCollection);
    }

    /**
     * Build rows/entities based on user given queryBuilder or default query builder.
     */
    private function buildEntities(): EntityBuilder
    {
        $request = $this->request->getCurrentRequest();
        $queryBuilder = $this->em->getRepository($this->gridConfig->getEntity())->createQueryBuilder('main_table');
        if ($this->gridConfig instanceof Searchable) {
            $queryBuilder = $this->gridConfig->getQueryBuilder();
        }

        $perPage = $this->gridConfig->getPerPage();

        return $this->entityBuilder
            ->setLimit($perPage)
            ->setPage($request->get('page', 1))
            ->setQueryBuilder($queryBuilder)
            ->setFields($this->getFieldMapping())
            ->build()
        ;
    }

    private function buildFieldMapping()
    {
        $this->fieldMapping = $this->fieldBuilder->setGrid($this->gridConfig)->buildFieldMapping();
    }

    private function getFieldMapping()
    {
        return $this->fieldMapping;
    }

    public function render()
    {
        $twig = $this->container->get('twig');

        return $twig->render('@PlutoGrid/grid.html.twig', [
            'header' => $this->buildHeader(),
            'entities' => $this->buildEntities(),
            'grid' => $this->gridConfig,
        ]);
    }
}
