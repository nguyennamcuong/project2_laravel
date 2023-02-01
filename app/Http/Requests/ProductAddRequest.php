<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' =>'bail|required| unique:products|max:255|min:10  ',
            'price'=>'required',
            'category_id'=>'required',
            'content'=>'required'
        ];
    }
    public function messages(){
        return[
            'name.required'=>'ten ko duoc de trong',
            'name.unique'=>'ten ko duoc phep trung',
            'name.max'=>'ten ko duoc vuot qua 255 ki tu',
            'name.min'=>'ten ko duoc it hon 10 ki tu',
            'price.required'=>'gia ko duoc de trong',
            'category_id.required'=>'danh muc ko duoc de trong',
            'content.required'=>'noi dung ko duoc de trong',
        ];
    }
}
