<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShopUsersController extends Controller
{
    //
    public function index()
    {
        $shopusers = ShopUser::paginate(5);
        return view('shopuser/index',compact('shopusers'));
    }

    public function create()
    {
        $shops = Shop::all();
        return view('shopuser/create',compact('shops'));
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required|max:20|unique:shop_users',
            'email'=>'required|email|unique:shop_users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'shop_id'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称长度不能大于20位',
            'name.unique'=>'该名称已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已存在',
            'password.required'=>'密码必须填写',
            'password.min'=>'密码长度不能小于6位',
            'password_confirmation.required'=>'请确认密码',
            'password.confirmed'=>'两次输入密码不一致',
            'shop_id.required'=>'所属商户必须选择',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
        ]);
        if (!$request->status){
            $request->status =0;
        }
        //密码加密
        $model = ShopUser::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'status'=>$request->status,
            'shop_id'=>$request->shop_id
        ]);
        return redirect()->route('shopusers.index')->with('success','添加成功');
    }

    public function show(Shopuser $shopuser,Request $request)
    {
        $shops = Shop::all();
        return view('shopuser/show',compact('shopuser','shops'));
    }

    public function edit(Shopuser $shopuser)
    {
        //dd($shopuser);
        $shops = Shop::all();
        return view('shopuser/edit',['shopuser'=>$shopuser,'shops'=>$shops]);
    }

    public function update(Shopuser $shopuser,Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>[
                'required',
                'max:20',
                Rule::unique('shop_users')->ignore($shopuser->id),

            ],
            'email'=>[
                'required',
                'string',
                'email',
                Rule::unique('shop_users')->ignore($shopuser->id),
            ],
            'shop_id'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称长度不能大于20位',
            'name.unique'=>'该名称已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已存在',
            'password_confirmation.required'=>'请确认密码',
            'password.confirmed'=>'两次输入密码不一致',
            'shop_id.required'=>'所属商户必须选择',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
            ]);
        if (!$request->status){
            $request->status =0;
        }
        $shopuser->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status,
            'shop_id'=>$request->shop_id
        ]);
        return redirect()->route('shopusers.index')->with('success','更新成功');
    }

    public function destroy(Shopuser $shopuser)
    {
        $shopuser->delete();
        return redirect()->route('shopusers.index')->with('success','删除成功');
    }
}
