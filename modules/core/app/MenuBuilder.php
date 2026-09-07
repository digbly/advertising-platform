<?php

namespace Modules\Core;

class MenuBuilder
{
    /**
     * Menu items being built.
     *
     * @var array<int, array{label: string, icon: string, route: string, active: ?string}>
     */
    private array $items = [];

    /**
     * Add a menu item.
     *
     * @param  string|null  $active  Optional routeIs pattern for the active state.
     */
    public function add(string $label, string $icon, string $route, ?string $active = null): self
    {
        $this->items[] = [
            'label' => $label,
            'icon' => $icon,
            'route' => $route,
            'active' => $active,
        ];

        return $this;
    }

    /**
     * Build the menu items array.
     *
     * @return array<int, array{label: string, icon: string, route: string, active: ?string}>
     */
    public function build(): array
    {
        return $this->items;
    }
}
