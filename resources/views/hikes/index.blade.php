@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Hikes</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('hikes.create') }}"> Create New Hike</a>
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
                    <th>Title</th>
                    <th>Distance</th>
                    <th>Difficulty</th>
                    <th>Done</th>
                    <th>Rating</th>
                    <th width="280px">Action</th>
                </tr>
                @if(count($hikes) > 0)
                    @foreach ($hikes as $hike)
                        <tr>
                            <td>{{ $hike->title }}</td>
                            <td>
                                @if($hike->distance == null)
                                    Not set
                                @else
                                    {{ $hike->distance }} km
                                @endif
                            </td>
                            <td>
                                @if($hike->difficulty == null)
                                    Not set
                                @else
                                    {{ $hike->difficulty }}
                                @endif
                            </td>
                            <td>
                                @if($hike->done)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                @if($hike->rating == null)
                                    Not set
                                @else
                                    {{ $hike->rating }}
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('hikes.destroy',$hike->id) }}" method="POST">

                                    <a class="btn btn-info" href="{{ route('hikes.show',$hike->id) }}">Show</a>

                                    @csrf
                                    @method('DELETE')

                                    @if(Auth::user()->id == $hike->user_id)
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    @endif
                                </form>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No hikes found</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
