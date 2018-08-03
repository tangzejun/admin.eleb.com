<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //验证是否登录
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $members = Member::paginate(5);
        return view('member/index',compact('members'));
    }

    public function create()
    {
        return view('member/create');
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'username'=>'required|max:20|unique:members',
            'tel'=>[
                'required',
                'regex:/^[1][3,4,5,7,8][0-9]{9}$/',
                'unique:members',
            ],
            'password' => 'required|between:6,20|confirmed',
            'password_confirmation' => 'required|between:6,20',
            'captcha' => 'required|captcha',
        ],[
            'username.required'=>'用户名不能为空',
            'username.max'=>'用户名长度不能大于20位',
            'username.unique'=>'该用户名已存在',
            'tel.required'=>'电话不能为空',
            'tell.regexl'=>'请输入正确电话',
            'tel.unique'=>'该电话已注册',
            'password.required'=>'密码必须填写',
            'password.between'=>'密码必须在6-20位之间！',
            'password_confirmation.required'=>'请确认密码',
            'password.confirmed'=>'两次输入密码不一致',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
        ]);
        Member::create([
            'username'=>$request->username,
            'tel'=>$request->tel,
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('members.index')->with('success','添加会员成功');
    }

    public function edit(Member $member)
    {
        return view('member/edit',compact('member'));
    }

    public function update(Member $member,Request $request)
    {
        //数据验证
        $this->validate($request,[
            'username'=>'required|max:20|unique:members',
            'tel'=>[
                'required',
                'regex:/^[1][3,4,5,7,8][0-9]{9}$/',
                'unique:members',
            ],
            'captcha' => 'required|captcha',
        ],[
            'username.required'=>'用户名不能为空',
            'username.max'=>'用户名长度不能大于20位',
            'username.unique'=>'该用户名已存在',
            'tel.required'=>'电话不能为空',
            'tell.regexl'=>'请输入正确电话',
            'tel.unique'=>'该电话已注册',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',
        ]);
        $member->update([
            'username'=>$request->username,
            'tel'=>$request->tel,
        ]);
        return redirect()->route('members.index')->with('success','更新成功');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success','删除成功');
    }
    
}
