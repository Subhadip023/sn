<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public ?string $title = 'User Dashboard';

    public function __construct($title = null)
    {
        $this->title = $title ?? 'User Dashboard';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.user');
    }
}
