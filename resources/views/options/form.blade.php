@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left;top: 10px;"><h3>{{$title}}</h3></div>
            <div class="col-md-6 heading-link-all" style="float: right;text-align: right;bottom: 10px;">
                <a class="btn btn-success" href="{{ url('questions-options') }}" > View Options</a>
            </div>
        </div>
        <form method="POST" onsubmit="return false" id="options_form">
            <input id="id" type="hidden" name="id" value="{{ isset($options_details->id)? $options_details->id : '' }}">
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="subject">Questions</label>
                        <select id="subject" name="subject" class="form-control" readonly>
                            <!--<option value=""> Select Questions</option>-->
                            @foreach ($questions as $sub)
                            @if($options_details->question_id==$sub->id)
                            <option value="{{$sub->id}}" {{isset($options_details->question_id)? $options_details->question_id==$sub->id?'selected':'':''}}> {{$sub->question_text}}</option>
                            @endif
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="option">Option </label>
                        <input id="option1" type="text" class="form-control" name="option" value="{{ isset($options_details->option)? $options_details->option : '' }}" >
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="correct" id="correct" {{ isset($options_details->correct) ?$options_details->correct==1? 'checked':'' : '' }}>
                                   <label class="form-check-label" for="correct">Correct</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer user-edit-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary float-right" id="{{$button=="save"?'submit_options_form':'update_options_form'}}">{{$button}}</button>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/custome/options.js') }}"></script>
@endsection
