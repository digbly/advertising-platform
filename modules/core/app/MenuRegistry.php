<?php

namespace Modules\Core;

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
     * @param  array<int, array{label: string, icon: string, route: string, active?: ?string}>  $items
     *
     * @throws InvalidArgumentException If the section is already registered.
     */
    public function register(string $section, array $items): void
    {
        if ($this->has($section)) {
            throw new InvalidArgumentException("Menu section [{$section}] is already registered.");
        }

        $this->sections[] = [
            'section' => $section,
            'items' => array_map(fn (array $item) => [
                'label' => $item['label'],
                'icon' => $item['icon'],
                'route' => $item['route'],
                'active' => $item['active'] ?? null,
            ], $items),
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
