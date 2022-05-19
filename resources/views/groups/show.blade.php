@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $group->name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('groups.index') }}">Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $group->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Users:</strong>
                @foreach($group->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Hikes:</strong>
                @if(count($group->hikes) > 0)
                    <ul>
                        @foreach($group->hikes as $hike)
                            <li>{{ $hike->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No hikes yet.</p>
                @endif
            </div>
    </div>
@endsection
