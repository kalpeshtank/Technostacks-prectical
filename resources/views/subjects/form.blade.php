@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left;top: 10px;"><h3>{{$title}}</h3></div>
            <div class="col-md-6 heading-link-all" style="float: right;text-align: right;bottom: 10px;">
                <a class="btn btn-success" href="{{ url('subjects') }}" > View Subjects</a>
            </div>
        </div>
        <form method="POST" onsubmit="return false" id="subject_form">
            <input id="id" type="hidden" name="id" value="{{ isset($subjects->id)? $subjects->id : '' }}">
            <div class="card-body">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ isset($subjects->title)? $subjects->title : '' }}"  autocomplete="Title">
                    </div>
                </div>
            </div>
            <div class="card-footer user-edit-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary float-right" id="submit_subject_form">{{$button}}</button>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/custome/subjects.js') }}"></script>
@endsection
