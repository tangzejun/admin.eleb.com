<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\Shop_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //列表
    public function index()
    {
        $shops = Shop::paginate(5);
        return view('shop/index',compact('shops'));
    }
    
    //添加
    public function create()
    {
        //获取分类
        $shop_categories = Shop_category::all();
        return view('shop/create',compact('shop_categories'));
    }

    //添加保存
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:20|unique:shops',
            'start_send'=>'required|numeric',
            'send_cost'=>'required|numeric',
            'notice'=>'required|max:200',
            'discount'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'shop_category_id.required'=>'店铺所属类型必选',
            'shop_name.required'=>'店铺名称必填',
            'shop_name.max'=>'店铺名称最大不能超过20个字符',
            'shop_name.unique'=>'店铺名称不能重复',
            'start_send.required'=>'起送金额必填',
            'start_send.numeric'=>'起送金额必须为数字',
            'send_cost.numeric'=>'配送金额必须为数字',
            'send_cost.required'=>'配送费必须填写',
            'notice.required'=>'店公告必须填写',
            'notice.max'=>'店公告最大字数不能超过200',
            'discount.required'=>'店铺优惠信息必须填写',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',

        ]);
        if (!$request->brand){
            $request->brand =0;
        }
        if (!$request->on_time){
            $request->on_time =0;
        }
        if (!$request->fengniao){
            $request->fengniao =0;
        }
        if (!$request->bao){
            $request->bao =0;
        }
        if (!$request->piao){
            $request->piao =0;
        }
        if (!$request->zhun){
            $request->zhun =0;
        }
        //处理上传文件
        $file = $request->shop_img;
        $fileName = $file->store('public/shop_img');
        $fileName = url(Storage::url($fileName));
        $model = Shop::create([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$fileName,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status
        ]);
        return redirect()->route('shops.index')->with('success','添加成功');
    }

    //显示
    public function show(Shop $shop,Request $request)
    {
        return view('shop/show',compact('shop'));
    }

    //修改
    public function edit(Shop $shop)
    {
        $shop_categories = Shop_category::all();
        return view('shop/edit',compact('shop','shop_categories'));
    }
    
    //更新保存
    public function update(Shop $shop,Request $request)
    {
        //数据验证
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:20',
            'start_send'=>'required|numeric',
            'send_cost'=>'required|numeric',
            'notice'=>'required|max:200',
            'discount'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'shop_category_id.required'=>'店铺所属类型必选',
            'shop_name.required'=>'店铺名称必填',
            'shop_name.max'=>'店铺名称最大不能超过20个字符',
            'start_send.required'=>'起送金额必填',
            'start_send.numeric'=>'起送金额必须为数字',
            'send_cost.numeric'=>'配送金额必须为数字',
            'send_cost.required'=>'配送费必须填写',
            'notice.required'=>'店公告必须填写',
            'notice.max'=>'店公告最大字数不能超过200',
            'discount.required'=>'店铺优惠信息必须填写',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',

        ]);
        if (!$request->brand){
            $request->brand =0;
        }
        if (!$request->on_time){
            $request->on_time =0;
        }
        if (!$request->fengniao){
            $request->fengniao =0;
        }
        if (!$request->bao){
            $request->bao =0;
        }
        if (!$request->piao){
            $request->piao =0;
        }
        if (!$request->zhun){
            $request->zhun =0;
        }
        //处理上传文件
        $file = $request->shop_img;
        $data = [
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status
        ];
        if($file){//有文件上传
            $fileName = $file->store('public/shop_img');
            $fileName = url(Storage::url($fileName));
            $data['shop_img']=$fileName;
        }
        $shop->update($data);
        //设置提示信息
        return redirect()->route('shops.index')->with('success','更新成功');
    }
    
    //删除
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success','删除成功');
    }
}
