@extends('layouts.app')
@section('content')
<div class="mx-5">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header p-0">
            <div class="col-md-6 heading" style="float: left;top: 5px;"><h2> Subjects</h2></div>
            <div class="col-md-6 heading-link heading-link-all" style="float: right;text-align: right;bottom: 9px;">
                <a class="btn btn-success" href="{{ url('subjects/create') }}" > Create</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="companies">
                <thead>
                    <tr>
                        <!--<th>#</th>-->
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $sub)
                    <tr>
                        <td>{{ $sub->title }}</td>
                        <td>{{ date('d-m-Y', strtotime($sub->created_at)) }}</td>
                        <td>
                            <form action="{{ route('subjects.destroy', $sub->id) }}" method="post">
                                <a href="{{ route('subjects.edit', $sub->id) }}" class="btn btn-primary user-edit">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete </button>
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
            {!! $subjects->links() !!}
        </div>
    </div>
</div>
@endsection
