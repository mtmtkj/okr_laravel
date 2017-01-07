<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Services\Timeline;
use App\InputPeriod;

class GuidePartialComposer
{
    /**
     * @var \App\Timeline
     */
    private $timeline;

    /**
     * @param \App\Timeline
     */
    public function __construct(Timeline $timeline)
    {
        $this->timeline = $timeline;
    }

    /**
     * @param \Illuminate\Contracts\View\View
     */
    public function compose(View $view)
    {
        $view->with([
            'currentPeriod' => $this->timeline->currentPeriod(),
        ]);
    }
}
