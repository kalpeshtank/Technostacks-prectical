@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header p-0">
            <div class="col-md-6 heading" style="float: left;top: 5px;"><h2> View Result</h2></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            @if(auth()->user()->user_type == "Admin")
                            <tr>
                                <th>User</th>
                                <td>{{ $test->user->name  }} ({{ $test->user->email  }})</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Date</th>
                                <td>{{ $test->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Result</th>
                                <td>{{ $test->result }}/{{$count}}</td>
                            </tr>
                        </table>
                        <?php $i = 1 ?>
                        @foreach($results as $result)
                        <table class="table table-bordered table-striped">
                            <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                                <th style="width: 10%">Question #{{ $i }}</th>
                                <th>{{ $result->question->question_text or '' }}</th>
                            </tr>
                            @if ($result->question->code_snippet != '')
                            <tr>
                                <td>Code snippet</td>
                                <td><div class="code_snippet">{!! $result->question->code_snippet !!}</div></td>
                            </tr>
                            @endif
                            <tr>
                                <td>Options</td>
                                <td>
                                    <ul>
                                        @foreach($result->question->options as $option)
                                        <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                            @if ($result->option_id == $option->id) text-decoration: underline @endif">
                                            {{ $option->option }}
                                            @if ($option->correct == 1) <em>(correct answer)</em> @endif
                                            @if ($result->option_id == $option->id) <em>(your answer)</em> @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Answer Explanation</td>
                                <td>
                                    {!! $result->question->answer_explanation  !!}
                                </td>
                            </tr>
                        </table>
                        <?php $i++ ?>
                        @endforeach
                    </div>
                </div>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</div>
@endsection
