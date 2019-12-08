<?php

namespace App\Http\Requests;


class UserAddressRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'province'      =>  'required',
            'city'          =>  'required',
            'district'      => 'required',
            'address'       => 'required|max:150|min:5',
            'zip'           => 'required|numeric|',
            'contact_name'  => 'required',
            'contact_phone' => 'required|numeric|regex:/^1[345789][0-9]{9}$/',
        ];
    }

    public function attributes()
    {
        return [
            'province'      =>  '省份',
            'city'          =>  '城市',
            'district'      => '地区',
            'address'       => '详细地址',
            'zip'           => '邮政编码',
            'contact_name'  => '姓名',
            'contact_phone' => '电话',
        ];
    }
}
