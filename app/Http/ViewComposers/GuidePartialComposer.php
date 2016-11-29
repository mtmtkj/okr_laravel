<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Services\Timeline;
use App\InputPeriod;

class GuidePartialComposer
{
    private $timeline;

    public function __construct(Timeline $timeline)
    {
        $this->timeline = $timeline;
    }

    public function compose(View $view)
    {
        $view->with([
            'timeline' => $this->timeline,
            'currentInputPeriod' => $this->timeline->currentInputPeriod(),
        ]);
    }
}
