@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $group->name }}</h2>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                @if($group->description)
                    <p>{{ $group->description }}</p>
                @else
                    <p>No description</p>
                @endif
            </div>
        </div>

        @if($group->users->contains(Auth::user()) || $group->user == Auth::user())
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hikes:</strong>
                    @if(count($group->hikes) > 0)
                        <ul>
                            @foreach($group->hikes as $hike)
                                <li>
                                    <a href="{{ route('hikes.show', $hike) }}">{{$hike->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hikes yet.</p>
                    @endif
                </div>
            </div>
        @endif

        @if(!$group->users->contains(Auth::user()))
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a class="btn btn-primary" href="{{ route('groups.join', $group->id) }}">Join</a>
            </div>
    @endif
@endsection
