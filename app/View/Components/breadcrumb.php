<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $items;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct(array $items = [], string $title = 'Dashboard')
    {
        $this->items = $items;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
