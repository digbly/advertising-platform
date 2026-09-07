<?php

namespace Modules\Core;

use Closure;
use InvalidArgumentException;

class MenuRegistry
{
    /**
     * Registered menu sections.
     *
     * @var array<int, array{section: string, items: array<int, array{label: string, icon: string, route: string, active: ?string}>}>
     */
    private array $sections = [];

    /**
     * Register a menu section with its items.
     *
     * @throws InvalidArgumentException If the section is already registered.
     */
    public function register(string $section, Closure $callback): void
    {
        if ($this->has($section)) {
            throw new InvalidArgumentException("Menu section [{$section}] is already registered.");
        }

        $builder = new MenuBuilder;
        $callback($builder);

        $this->sections[] = [
            'section' => $section,
            'items' => $builder->build(),
        ];
    }

    /**
     * Check if a menu section is registered.
     */
    public function has(string $section): bool
    {
        return collect($this->sections)->contains(fn (array $group) => $group['section'] === $section);
    }

    /**
     * Get all registered menu sections.
     *
     * @return array<int, array{section: string, items: array<int, array{label: string, icon: string, route: string, active: ?string}>}>
     */
    public function all(): array
    {
        return $this->sections;
    }
}
