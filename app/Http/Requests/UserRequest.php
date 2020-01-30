<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|between:2,25|unique:users,name,' . Auth::id(),
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=50,min_height=50',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' =>'头像必须是 jpeg, bmp, png, gif 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 50px 以上',
            'name.unique' => '用户名已被占用，请重新填写',
            'name.between' => '用户名必须介于 2 - 25 个字符之间。',
            'name.required' => '用户名不能为空。',
        ];
    }
}