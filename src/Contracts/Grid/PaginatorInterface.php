<?php

namespace Pluto\GridBundle\Contracts\Grid;

interface PaginatorInterface
{
    public function getPages(): array;

    public function getCurrentPage(): int;

    public function getTemplate();
}
