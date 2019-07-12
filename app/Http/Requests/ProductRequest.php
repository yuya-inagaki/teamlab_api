<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == '/product/create'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100', //最低３文字,最大100文字
            'description' => 'required|max:500', //最大500文字
            'price' => 'required|digits_between:1,10', //1から10桁までの数字
            'image' => 'required|image|max:3000', //3000kb(3MB)以下のファイル
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名は必ず入力してください',
        ];
    }
}
