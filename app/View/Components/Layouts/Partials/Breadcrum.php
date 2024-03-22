<?php

namespace App\View\Components\Layouts\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrum extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $subTitle;
    public $itemActive;
    public $route;

    public function __construct($title, $itemActive, $route, $subTitle)
    {
        $this->subTitle = $subTitle;
        $this->title = $title;
        $this->itemActive = $itemActive;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $subTitle = $this->subTitle;
        $title = $this->title;
        $itemActive = $this->itemActive;
        $route = $this->route;

        return view('components.layouts.partials.breadcrum', compact('title', 'itemActive', 'route', 'subTitle'));
    }
}
