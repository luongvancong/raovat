@extends('frontend/layout/default')

@section('styles')
<link rel="stylesheet" href="/bower_components/dropzone/dist/min/dropzone.min.css">
<style>
    .dropzone {
        border: 2px dashed #ccc;
        line-height: 50px;
    }

    .btn-success-upload:hover {
        color: #fff;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12 mg-bt-30">
        <div class="page-head mg-bt-10">
            <div class="page-head-block">Upload ảnh sản phẩm {{ $product->getName() }}</div>
        </div>
        <form action="{{ Request::url() }}" class="dropzone" id="my-awesome-dropzone"></form>

        <a href="javascript:window.history.back()" class="hide btn-success-upload btn btn-black btn-flat mg-t-10">Hoàn thành</a>
    </div>
</div>
@stop

@section('scripts')
<script src="/bower_components/dropzone/dist/min/dropzone.min.js"></script>
<script>
    $(function() {
        Dropzone.autoDiscover = false;
        $("#my-awesome-dropzone").dropzone({

            url : '{{ Request::url() }}?_token={{ csrf_token() }}',
            dictDefaultMessage : 'Kéo thả hoặc click vào đây để upload ảnh',
            dictFallbackMessage : 'Trình duyệt của bạn không hỗ trợ kéo thả ảnh',
            dictInvalidFileType : 'File này không được phép upload',
            acceptedFiles : 'image/*',
            success : function(e, response) {

                if(response.statusCode == 200) {

                    // Show btn succss
                    $('.btn-success-upload').removeClass('hide');
                }
            }
        });
    });
</script>
@stop