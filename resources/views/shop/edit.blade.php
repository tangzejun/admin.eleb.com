@extends('default')
@section('css_files')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

@stop
@section('js_files')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@section('contents')
    <h1>修改店铺</h1>
    @include('_error')
    <form action="{{ route('shops.update',[$shop]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput1">店铺名称</label>
            <input type="text" name="shop_name"  value="{{ $shop->shop_name }}" class="form-control" id="exampleInput1" placeholder="shop_name">
        </div>
        <div class="form-group">
            <label>店铺分类</label>
            <select name="shop_category_id" class="form-control">
                @foreach($shop_categories as $shop_category)
                    <option value="{{ $shop_category->id }}" @if($shop->shop_category_id==$shop_category->id)selected="selected"@endif>{{ $shop_category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="hidden" name="img" id="img_url">
            <input type="hidden" name="old_img" value="{{ $shop->shop_img }}">
        {{--<input type="file" name="img">--}}
        <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img src="{{ $shop->shop_img }}" width="90" id="img">
        </div>
        <div class="form-group">
            <label for="exampleInput2">店铺评分</label>
            <input type="text" name="shop_rating"  value="{{ $shop->shop_rating }}" class="form-control" id="exampleInput2" placeholder="shop_ratinge">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="brand" value="{{ $shop->brand }}" @if($shop->brand==1)checked @endif> 是否品牌
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="on_time" value="{{ $shop->on_time }}" @if($shop->on_time==1)checked @endif> 是否准时达
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="fengniao" value="{{ $shop->fengniao }}" @if($shop->fengniao==1)checked @endif> 是否蜂鸟配送
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="bao" value="{{ $shop->bao }}" @if($shop->bao==1)checked @endif> 是否保标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="piao" value="{{ $shop->piao }}" @if($shop->piao==1)checked @endif> 是否票标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="zhun" value="{{ $shop->zhun }}" @if($shop->zhun==1)checked @endif> 是否准标记
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInput3">起送金额</label>
            <input type="number" name="start_send"  value="{{ $shop->start_send }}" class="form-control" id="exampleInput3" placeholder="start_send">
        </div>
        <div class="form-group">
            <label for="exampleInput4">配送费</label>
            <input type="number" name="send_cost"  value="{{ $shop->send_cost }}" class="form-control" id="exampleInput4" placeholder="send_cost">
        </div>
        <div class="form-group">
            <label for="exampleInput5">店公告</label>
            {{--<input type="text" name="notice"  value="{{ old('notice') }}" class="form-control" id="exampleInput5" placeholder="notice">--}}
            <textarea class="form-control" rows="3" name="notice" placeholder="notice">{{ $shop->notice }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInput6">优惠信息</label>
            {{--<input type="text" name="notice"  value="{{ old('notice') }}" class="form-control" id="exampleInput6" placeholder="notice">--}}
            <textarea class="form-control" rows="3" name="discount" placeholder="discount">{{ $shop->discount }}</textarea>

        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="1" @if($shop->status==1)checked @endif>正常
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="0" @if($shop->status==0)checked @endif>待审核
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="-1" @if($shop->status==-1)checked @endif>禁用
            </label>
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@endsection

@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,


            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{ route('upload') }}",


            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:"{{ csrf_token() }}"
            }
        });

        uploader.on('uploadSuccess',function (file,response) {
            console.log(response)
            $file = response.fileName

            $('#img').attr('src',$file)
            $('#img_url').val($file)
        });
    </script>
@endsection