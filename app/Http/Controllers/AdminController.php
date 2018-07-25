<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //
    public function index()
    {
        $admins = Admin::paginate(5);
        return view('admin/index',compact('admins'));
    }

    public function create()
    {
        return view('admin/create');
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required|max:20|unique:shop_users',
            'email'=>'required|email|unique:shop_users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
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
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
        ]);
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('admins.index')->with('success','添加成功');
    }

    public function show(Admin $admin,Request $request)
    {
        return view('admin/show',compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin/edit',compact('admin'));
    }

    public function update(Admin $admin,Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>[
                'required',
                'max:20',
                Rule::unique('admins')->ignore($admin->id),

            ],
            'email'=>[
                'required',
                'string',
                'email',
                Rule::unique('admins')->ignore($admin->id),
            ],
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称长度不能大于20位',
            'name.unique'=>'该名称已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已存在',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
        ]);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        return redirect()->route('admins.index')->with('success','更新成功');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除成功');
    }

    public function editPassword()
    {
        return view('admin/password');
    }

    public function updatePassword(Request $request)
    {
        //数据验证
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
            'captcha' => 'required|captcha',
        ],[
            'old_password.required'=>'必须输入旧密码',
            'password.required'=>'请设置新密码',
            'password.confirmed'=>'两次密码输入不一致,请重新输入',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
        ]);


        if(Hash::check($request->old_password,auth()->user()->password)){
            $new_password = bcrypt($request->password);
            $id = auth()->user()->id;
            Admin::where('id',$id)->update([
                'password'=>$new_password,
            ]);
            Auth::logout();
            //修改保存成功,跳转登录页面
            return redirect('login')->with('success','密码修改成功,请重新登录');
        }else{
            //旧密码输入不正确
            return redirect()->route('admin.editPassword')->with('danger','旧密码输入错误,请重新输入');
        }
    }


}
