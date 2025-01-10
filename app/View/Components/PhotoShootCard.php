<?php

namespace App\View\Components;

use Closure;
use App\Models\PhotoShoot;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PhotoShootCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $photoshoot;

    public function __construct(PhotoShoot $photoshoot)
    {
        $this->photoshoot = $photoshoot;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.photo-shoot-card', [
            'photoshoot' => $this->photoshoot
        ]);
    }
}
