<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'tag_id' => 'required',
            'excerpt' => 'required',
            'published_at' => 'required|before_or_equal:'.Carbon::now()->toDateTimeString(),
            'municipio' => 'required',
            'address_id' => 'required',
            'time' => 'required',
        ];
    }
}
