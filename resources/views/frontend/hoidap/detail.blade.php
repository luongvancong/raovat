@extends('frontend/layout/default')

@section('content')

<div id="hoidap-page-detail">
    <div id="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', url()) !!}
            {!! getBreadcrumbItem('Hỏi đáp', route('hoidap.index')) !!}
            {!! getBreadcrumbItem($question->getQuestion(), '' ,true) !!}
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h1 class="heading">{{ $question->getQuestion() }}</h1>
            <div class="question">
                <div>
                    <div class="user-avatar pull-left">
                        <img src="/images/avatar.jpg" alt="{{ $question->getUser() }}">
                    </div>
                    <div class="question-info pull-left">
                        <p class="user-name">{{ $question->getUser() }}</p>
                        <p class="question-time">{{ $question->getCreatedAt() }}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <h2 class="question-des">{{ strip_tags($question->getContent()) }}</h2>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="answer-container">
                <h2 class="ans-heading">Câu trả lời <span class="label label-info">{{ $question->answer->count() }}</span></h2>
                <div class="answers">
                    @foreach($question->answer->all() as $ans)
                        <div class="item">
                            <div class="user">
                                <div class="avatar pull-left">
                                    <img src="/images/avatar.jpg" alt="{{ $ans->getUser() }}">
                                </div>
                                <div class="info pull-left">
                                    <p class="user-name">{{ $ans->getUser() }}</p>
                                    <p class="answer-time">{{ $ans->getCreatedAt() }}</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="answer">{!! $ans->getAnswer() !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@stop