<?php

namespace App\View\Components\Quotation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */

    public $routeSend;
    public $quotation;
    public $typeCase;
    public $lawyer;
    public $currencies;
    public $readonly;

    public function __construct($quotation, $routeSend = null, $typeCase = null, $lawyer = null, $currencies = null, bool $readonly = false)
    {
        $this->routeSend = $routeSend;
        $this->quotation = $quotation;
        $this->typeCase = $typeCase;
        $this->lawyer = $lawyer;
        $this->currencies = $currencies;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $routeSend = $this->routeSend;
        $quotation = $this->quotation;
        $typeCase = $this->typeCase;
        $lawyer = $this->lawyer;
        $currencies = $this->currencies;
        $readonly = $this->readonly;

        return view('components.quotation.form', compact('quotation', 'typeCase', 'lawyer', 'currencies', 'routeSend', 'readonly'));
    }
}
