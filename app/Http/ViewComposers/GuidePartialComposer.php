<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Services\Timeline;

class GuidePartialComposer
{
    /**
     * @var \App\Services\Timeline
     */
    private $timeline;

    /**
     * @param \App\Services\Timeline
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
