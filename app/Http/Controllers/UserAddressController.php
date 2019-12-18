<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests\UserAddressRequest;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
        return view('user_addresses.index', [
            'addresses' => $request->user()->addresses,
        ]);
    }

    public function create(Request $request){

        return view('user_addresses.create_and_edit',['address'=>new UserAddress()]);
    }

    public function store(UserAddressRequest $request)
    {
        //$request->user() 获取当前登录用户。
        //user()->addresses() 获取当前用户与地址的关联关系
        //addresses()->create() 在关联关系里创建一个新的记录。
        //$request->only() 通过白名单的方式从用户提交的数据里获取我们所需要的数据
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    public function edit (UserAddress $user_address){
        $this->authorize('own', $user_address);
        return view('user_addresses.create_and_edit', ['address' => $user_address]);
    }

    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        $this->authorize('own', $user_address);
        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    public function delete(UserAddress $user_address){
        $this->authorize('own', $user_address);
        $user_address->delete();
        return [];

    }
}
