@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Groups</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('groups.create') }}"> Create New group</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <table class="table table-bordered table-responsive-lg">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                @if($groups)
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->description }}</td>
                            <td>{{ $group->created_at }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('groups.show',$group->id) }}">Show</a>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection
