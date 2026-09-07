<?php

namespace Modules\Core;

use InvalidArgumentException;

class SettingConfigBuilder
{
    private string $label = '';

    private array $rules = [];

    private mixed $default = null;

    private string $description = '';

    private string $group = 'general';

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function rules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    public function default(mixed $default): self
    {
        $this->default = $default;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function group(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Build the immutable SettingConfig.
     *
     * @throws InvalidArgumentException If rules is empty.
     */
    public function build(string $key): SettingConfig
    {
        if (empty($this->rules)) {
            throw new InvalidArgumentException("Setting [{$key}] must have at least one validation rule.");
        }

        return new SettingConfig(
            key: $key,
            label: $this->label ?: $key,
            rules: $this->rules,
            default: $this->default,
            description: $this->description,
            group: $this->group,
        );
    }
}
