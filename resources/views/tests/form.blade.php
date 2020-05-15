@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left;top: 10px;"><h3>New Test</h3></div>
            <div class="panel-heading">
                Answer these {{count($questions)}} questions.    
            </div>
        </div>
        <!--<div class="panel-body">-->
        <form method="POST" onsubmit="return false" id="test_ans_form">
            <div class="card-body">
                @if(count($questions) > 0)
                <?php $i = 1; ?>
                @foreach($questions as $question)
                @if ($i > 1) <hr /> @endif
                <div class="form-row">
                    <div class="col-xs-12 col-md-12 form-group">
                        <div class="form-group">
                            <strong>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong>

                            @if ($question->code_snippet != '')
                            <div class="code_snippet">{!! $question->code_snippet !!}</div>
                            @endif

                            <input
                                type="hidden"
                                name="questions[{{ $i }}]"
                                value="{{ $question->id }}">
                            @foreach($question->options as $option)
                            <br>
                            <label class="radio-inline">
                                <input
                                    type="radio"
                                    name="answers[{{ $question->id }}]"
                                    value="{{ $option->id }}">
                                {{ $option->option }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach
                @endif
            </div>
            <div class="card-footer user-edit-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary float-right" id="submit_test_form">Submit answers</button>
                </div> 
            </div>
        </form>
    </div>

    <!--</div>-->
</div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/custome/tests.js') }}"></script>
@endsection