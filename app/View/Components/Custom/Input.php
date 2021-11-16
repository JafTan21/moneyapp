<?php

namespace App\View\Components\Custom;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $model;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $model, $type = 'text')
    {
        $this->label = $label;
        $this->model = $model;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.custom.input');
    }
}