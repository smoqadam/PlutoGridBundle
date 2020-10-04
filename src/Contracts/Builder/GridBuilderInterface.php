<?php

namespace Pluto\GridBundle\Contracts\Builder;

use Pluto\GridBundle\Contracts\Grid\GridConfiguratorInterface;
use Pluto\GridBundle\Contracts\Grid\GridInterface;

interface GridBuilderInterface
{
    public function build(GridConfiguratorInterface $grid): GridInterface;
}
