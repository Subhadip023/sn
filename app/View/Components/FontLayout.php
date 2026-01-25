<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FontLayout extends Component
{
        
    public ?string $title;
    public ?array $pages=[];

    public function __construct($title=null, $pages=[])
    {
        $this->title = $title;
        $this->pages = $pages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.fontpage');
    }
}
