<?php

namespace App\View\Components\LossReduction;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CaseNavigationComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.loss-reduction.case-navigation-component');
    }
}
