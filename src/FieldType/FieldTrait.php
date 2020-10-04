<?php

namespace Pluto\GridBundle\FieldType;

trait FieldTrait
{
    private ?string $value;

    private string $template;

    private $filed;

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->filed;
    }

    /**
     * @param mixed $key
     */
    public function setField($field)
    {
        $this->filed = $field;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}
