<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

abstract class FormRequest extends BaseFormRequest
{
    /**
     * 隠しフィールドを除いたリクエストデータを返す
     *
     * @return array
     */
    public function data()
    {
        return $this->except(['_token', '_method']);
    }
}
