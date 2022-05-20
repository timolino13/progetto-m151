@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Groups</h2>
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
                    <th>Created by</th>
                    <th>Action</th>
                </tr>
                @if(count($groups) > 0)
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->description }}</td>
                            <td>{{ $group->created_at }}</td>
                            <td>{{ $group->user->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('groups.show',$group->id) }}">Show</a>
                                @if(!$group->users->contains(Auth::user()))
                                    <a class="btn btn-primary" href="{{ route('groups.join', $group->id) }}">Join</a>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No groups found</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
