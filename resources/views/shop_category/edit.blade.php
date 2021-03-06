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
    <h1>修改商家分类</h1>
    @include('_error')
    <form action="{{ route('shop_categories.update',[$shop_category]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput1">分类名称</label>
            <input type="text" name="name"  value="{{ $shop_category->name }}" class="form-control" id="exampleInput1" placeholder="name">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="hidden" name="img" id="img_url">
            <input type="hidden" name="old_img" value="{{ $shop_category->img }}">
        {{--<input type="file" name="img">--}}
        <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img src="{{ $shop_category->img }}" width="90" id="img">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="status" value="{{ $shop_category->status }}" @if($shop_category->status==1)checked @endif> 是否显示
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