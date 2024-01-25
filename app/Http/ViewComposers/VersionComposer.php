<?php

// app/Http/ViewComposers/VersionComposer.php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Version;

class VersionComposer{
    public function compose(View $view){
        $ultimaVersion = Version::orderBy('version', 'desc')->first();
        $view->with('ultimaVersion', $ultimaVersion);
    }
}