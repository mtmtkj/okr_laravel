<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\InputPeriod;

class GuidePartialComposer
{
    private $inputPeriod;

    public function __construct(InputPeriod $inputPeriod)
    {
        $this->inputPeriod = $inputPeriod;
    }

    public function compose(View $view)
    {
        $currentInputPeriod = $this->inputPeriod->currentOne();
        $alertLevel = $currentInputPeriod->getAlertLevel(Carbon::now());

        $view->with(compact('currentInputPeriod', 'alertLevel'));
    }
}
