<?php

namespace App\View\Components\admin;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public $account = [];
    /**
     * Create a new component instance.
     */
    public function __construct($account = [])
    {
        $account = User::get()->except(auth()->id());
        $this->account = $account;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.page-header');
    }
}
