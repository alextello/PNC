<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
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
        // $id = $this->request->get('id') ? ',' . $this->request->get('id') : '';
        return [
            'title' => 'required',
            'body' => 'required',
            'tag_id' => 'required',
            'published_at' => 'required|before_or_equal:'.Carbon::now()->format('d-m-Y'),
            'aldea' => 'required',
            'oficio' => 'required|regex:/^([0-9]{4})-([0-9]{4})$/|unique:posts,oficio,'.$this->post->id,
            'address_id' => 'required',
            'time' => 'required',
            'jefe_de_turno_id' => 'required',
            'modus_operandi_id' => 'nullable',
            'typology_id' => 'nullable'
        ];
    }
}
