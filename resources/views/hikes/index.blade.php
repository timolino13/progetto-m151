@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('hikes.create') }}"> Create New Hike</a>
            </div>
        </div>
    </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Rating</th>
                <th>Date Created</th>
                <th width="280px">Action</th>
            </tr>
            @if($hikes)
                @foreach ($hikes as $hike)
                    <tr>
                        <td>{{ $hike->title }}</td>
                        <td>{{ $hike->description }}</td>
                        <td>{{ $hike->rating }}</td>
                        <td>{{ $hike->created_at }}</td>
                        <td>
                            <form action="{{ route('hikes.delete',$hike->id) }}" method="POST">

                                <a class="btn btn-info" href="{{ route('hikes.show',$hike->id) }}">Show</a>

                                <a class="btn btn-primary" href="{{ route('hikes.edit',$hike->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@endsection
