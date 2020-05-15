@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header p-0">
            <div class="col-md-6 heading" style="float: left;top: 5px;"><h2> Option</h2></div>
            <!--            <div class="col-md-6 heading-link heading-link-all" style="float: right;text-align: right;bottom: 9px;">
                            <a class="btn btn-success" href="{{ url('questions/create') }}" > Create</a>
                        </div>-->
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="companies">
                <thead>
                    <tr>
                        <!--<th>#</th>-->
                        <th>Questions</th>
                        <th>Option</th>
                        <th>Correct</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questionsOptions as $option)
                    <tr>
                        <td>{{ isset($option->question)?$option->question->question_text:'' }}</td>
                        <td>{{ $option->option }}</td>
                        <td>{{ $option->correct == 1 ? 'Yes' : 'No' }}</td>
                        <td>{{ date('d-m-Y', strtotime($option->created_at)) }}</td>
                        <td>
                            <form action="{{ route('questions-options.destroy', $option->id) }}" method="post">
                                <a href="{{ route('questions-options.edit', $option->id) }}" class="btn btn-primary user-edit">Edit</a>
                                @csrf
                                @method('DELETE')
                                <!--<button type="submit" class="btn btn-danger">Delete </button>-->
                            </form>
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
            {!! $questionsOptions->links() !!}
        </div>
    </div>
</div>
@endsection
