<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateForm extends Component
{
    /**
     * Propiedad pública para mantener el arreglo de datos enviados desde la vista principal.
     */
    // public $data;
    public $sendRoute;
    public $person;

    /**
     * Constructor para crear una nueva instancia del componente.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct(string $sendRoute, object $person = null)
    {
        $this->sendRoute = $sendRoute;
        $this->person = $person;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sendRoute =  $this->sendRoute;
        $person =  $this->person;
        return view('components.user.create-form', compact('sendRoute', 'person'));
    }
}
