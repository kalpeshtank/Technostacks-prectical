@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left;top: 10px;"><h3>{{$title}}</h3></div>
            <div class="col-md-6 heading-link-all" style="float: right;text-align: right;bottom: 10px;">
                <a class="btn btn-success" href="{{ url('questions') }}" > View Questions</a>
            </div>
        </div>
        <form method="POST" onsubmit="return false" id="questions_form">
            <input id="id" type="hidden" name="id" value="{{ isset($questions->id)? $questions->id : '' }}">
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" class="form-control">
                            <option value=""> Select Subject</option>
                            @foreach ($subject as $sub)
                            <option value="{{$sub->id}}" {{isset($questions->subject_id)? $questions->subject_id==$sub->id?'selected':'':''}}> {{$sub->title}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group col-md-12">
                        <label for="title">Question text</label>
                        <textarea class="form-control " placeholder="" name="question_text" cols="50" rows="3" id="question_text" spellcheck="false">{{ isset($questions->question_text)? $questions->question_text : '' }}</textarea>
                    </div>
                    @if($button=="save")
                    <div class="form-group col-md-6">
                        <label for="option1">Option #1</label>
                        <input id="option1" type="text" class="form-control" name="option1" value="{{ isset($questions->option1)? $questions->option1 : '' }}" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="option2">Option #2</label>
                        <input id="title" type="option2" class="form-control" name="option2" value="{{ isset($questions->option2)? $questions->option2 : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="option3">Option #3</label>
                        <input id="title" type="option3" class="form-control" name="option3" value="{{ isset($questions->option3)? $questions->option3 : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="option4">Option #4</label>
                        <input id="option4" type="text" class="form-control" name="option4" value="{{ isset($questions->option4)? $questions->option4 : '' }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="correct">Correct</label>
                        <select id="correct" name="correct" class="form-control">
                            <option value=""> Select correct Answers</option>
                            <option value="option1">Option #1</option>
                            <option value="option2">Option #2</option>
                            <option value="option3">Option #3</option>
                            <option value="option4">Option #4</option>
                        </select> 
                    </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label for="code_snippet">Code snippet</label>
                        <textarea class="form-control " placeholder="" name="code_snippet" cols="50" rows="3" id="code_snippet" spellcheck="false">{{ isset($questions->code_snippet)? $questions->code_snippet : '' }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="answer_explanation">Answer explanation</label>
                        <textarea class="form-control " placeholder="" name="answer_explanation" cols="50" rows="3" id="answer_explanation" spellcheck="false">{{ isset($questions->answer_explanation)? $questions->answer_explanation : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer user-edit-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary float-right" id="{{$button=="save"?'submit_questions_form':'update_questions_form'}}">{{$button}}</button>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/custome/question.js') }}"></script>
@endsection
