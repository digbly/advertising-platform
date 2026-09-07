<?php

namespace Modules\Core;

use InvalidArgumentException;

class SettingConfig
{
    public function __construct(
        private readonly string $key,
        private readonly string $label,
        private readonly array $rules,
        private readonly mixed $default = null,
        private readonly string $description = '',
        private readonly string $group = 'general',
    ) {
        if (empty($this->rules)) {
            throw new InvalidArgumentException("Setting [{$this->key}] must have at least one validation rule.");
        }
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getDefault(): mixed
    {
        return $this->default;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'label' => $this->label,
            'rules' => $this->rules,
            'default' => $this->default,
            'description' => $this->description,
            'group' => $this->group,
        ];
    }
}
