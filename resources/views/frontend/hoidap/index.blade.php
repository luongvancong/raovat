@extends('frontend/hoidap/layout')


@section('content')

<div id="hoidap-page">
    <div id="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', url()) !!}
            {!! getBreadcrumbItem('Hỏi đáp', '', true) !!}
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-{{ $col }}">
            <div class="page-head mg-bt-15">
                <h1 class="page-head-block heading pd-bt-5">Mới nhất</h1>
            </div>
            <div class="row">
                @foreach($questions as $qs)
                    <div class="col-sm-12">
                        <div class="hoidap-item pd-bt-20">
                            <div class="bound row">
                                <div class="infomation col-sm-12">
                                    <h3 class="title pd-bt-5 pd-t-5">
                                        <a href="{{ $qs->getUrl() }}" title="{{ $qs->getQuestion() }}">{{ $qs->getQuestion() }}</a>
                                    </h3>
                                    <?php $countAns = $qs->answer->count() ?>

                                    <h5 class="count-answer">{{ $countAns }} câu trả lời</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-sm-{{ $col }}">
            <div class="page-head mg-bt-15">
                <h2 class="page-head-block heading pd-bt-5">Xem nhiều trong tuần</h2>
            </div>
            <div class="row">
                @foreach($questionHasMostAnswers as $qs)
                    <div class="col-sm-12">
                        <div class="hoidap-item pd-bt-20">
                            <div class="bound row">
                                <div class="infomation col-sm-12">
                                    <h3 class="title pd-bt-5 pd-t-5">
                                        <a href="{{ $qs->getUrl() }}" title="{{ $qs->getQuestion() }}">{{ $qs->getQuestion() }}</a>
                                    </h3>
                                    <?php $countAns = $qs->answer->count() ?>

                                    <h5 class="count-answer">{{ $countAns }} câu trả lời</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Nếu số cột = 4 thì mới show thằng này ra --}}
        @if($col == 4)
        <div class="col-sm-{{ $col }}">
            <div class="page-head mg-bt-15">
                <h2 class="page-head-block heading pd-bt-5">Nổi bật trong tuần</h2>
            </div>
            <div class="row">
                @foreach($questions7DaysAgo as $qs)
                    <div class="col-sm-12">
                        <div class="hoidap-item pd-bt-20">
                            <div class="bound row">
                                <div class="infomation col-sm-12">
                                    <h3 class="title pd-bt-5 pd-t-5">
                                        <a href="{{ $qs->getUrl() }}" title="{{ $qs->getQuestion() }}">{{ $qs->getQuestion() }}</a>
                                    </h3>
                                    <?php $countAns = $qs->answer->count() ?>

                                    <h5 class="count-answer">{{ $countAns }} câu trả lời</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>

    <div class="row">
        <div class="col-sm-12 text-center">{!! pagination($questions, $questions->total(), $questions->perPage())  !!}</div>
    </div>

</div>
@stop