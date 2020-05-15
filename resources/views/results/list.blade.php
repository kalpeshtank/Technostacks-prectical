@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header p-0">
            <div class="col-md-6 heading" style="float: left;top: 5px;"><h2> Results</h2></div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="companies">
                <thead>
                    <tr>
                        <!--<th>#</th>-->
                        @if(auth()->user()->user_type == "Admin")
                        <th>User</th>
                        @endif
                        <th>Created at</th>
                        <th>Result</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($results as $res)
                    <tr>
                        @if(auth()->user()->user_type == "Admin")
                        <td>{{isset($res->user)? $res->user->name:''  }} ({{ $res->user->email  }})</td>
                        @endif
                        <td>{{ date('d-m-Y H:i A', strtotime($res->created_at)) }}</td>
                        <td>{{ $res->result }}/{{$count}}</td>
                        <td>
                            <a href="{{ route('results.show',[$res->id]) }}" class="btn btn-primary user-edit">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center;font-weight: bold">
                            Data Not Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
