@foreach($questions as $question)
    @if($countAns = $question->answer->count())
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne_{{ $question->getId() }}">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{ $question->getId() }}">
                    <span class="badge">{{ $countAns }}</span> {{ $question->getQuestion() }}
                </a>
            </h4>
        </div>
        <div id="collapseOne_{{ $question->getId() }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                @foreach($question->answer->all() as $answer)
                <div class="comment-item clearfix">
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="comment-user">
                                <img src="/images/grey.gif" alt="{{ $answer->getUser() }}">
                            </div>
                        </div>
                        <div class="col-sm-11">
                            <div class="commentContent">
                                {!! $answer->getAnswer() !!}
                                <div class="user-info">
                                    <div class="pull-left">
                                        <span>{{ $answer->getUser() }}</span> - <time datetime="">{{ $answer->getCreatedAt() }}</time>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endforeach