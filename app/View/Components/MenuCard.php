<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuCard extends Component
{
    public $menu;
    public $showAction;

    /**
     * Create a new component instance.
     */
    public function __construct($menu, $showAction = true)
    {
        $this->menu = $menu;
        $this->showAction = $showAction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-card');
    }
}
