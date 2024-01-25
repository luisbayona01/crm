<?php

// app/Http/ViewComposers/PaginawebComposer.php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Paginaweb;

class PaginawebComposer{
    public function compose(View $view){
        $paginaweb = Paginaweb::where('userid', auth()->user()->id)->first();
        $view->with('paginaweb', $paginaweb);
    }
}