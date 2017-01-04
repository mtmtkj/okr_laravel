<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\InputPeriod;

class GuidePartialComposer
{
    private $inputPeriod;

    /**
     * @param InputPeriod $inputPeriod
     */
    public function __construct(InputPeriod $inputPeriod)
    {
        $this->inputPeriod = $inputPeriod;
    }

    /**
     * $view に対してテンプレート変数をセットする
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $currentInputPeriod = $this->inputPeriod->currentOne();
        $alertLevel = $currentInputPeriod->getAlertLevel(Carbon::now());

        $view->with(compact('currentInputPeriod', 'alertLevel'));
    }
}
