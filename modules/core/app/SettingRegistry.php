<?php

namespace Modules\Core;

use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

class SettingRegistry
{
    /** @var array<string, SettingConfig> */
    private array $settings = [];

    /**
     * Register a setting with its configuration.
     *
     * @throws InvalidArgumentException If the key is already registered.
     */
    public function register(string $key, Closure $callback): void
    {
        if (isset($this->settings[$key])) {
            throw new InvalidArgumentException("Setting [{$key}] is already registered.");
        }

        $builder = new SettingConfigBuilder;
        $callback($builder);

        $this->settings[$key] = $builder->build($key);
    }

    /**
     * Get a registered setting configuration.
     *
     * @throws InvalidArgumentException If the key is not registered.
     */
    public function get(string $key): SettingConfig
    {
        if (!isset($this->settings[$key])) {
            throw new InvalidArgumentException("Setting [{$key}] is not registered.");
        }

        return $this->settings[$key];
    }

    /**
     * Check if a setting key is registered.
     */
    public function has(string $key): bool
    {
        return isset($this->settings[$key]);
    }

    /**
     * Get all registered settings.
     *
     * @return array<string, SettingConfig>
     */
    public function all(): array
    {
        return $this->settings;
    }

    /**
     * Get validation rules for a setting.
     *
     * @throws InvalidArgumentException If the key is not registered.
     */
    public function rules(string $key): array
    {
        return $this->get($key)->getRules();
    }

    /**
     * Validate a value against a registered setting's rules.
     *
     * @throws InvalidArgumentException If the key is not registered.
     * @throws ValidationException If validation fails.
     */
    public function validate(string $key, mixed $value): void
    {
        $config = $this->get($key);

        $validator = Validator::make(
            ['value' => $value],
            ['value' => $config->getRules()],
            ['value.' => "Setting [{$key}] validation failed."],
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
    }

    /**
     * Get all settings in a specific group.
     *
     * @return array<string, SettingConfig>
     */
    public function getByGroup(string $group): array
    {
        return array_filter(
            $this->settings,
            fn (SettingConfig $config) => $config->getGroup() === $group,
        );
    }

    /**
     * Remove a registered setting (useful for testing).
     */
    public function forget(string $key): void
    {
        unset($this->settings[$key]);
    }
}
