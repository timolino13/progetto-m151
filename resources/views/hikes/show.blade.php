@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show hike</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $hike->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description</strong>
                {{ $hike->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rating</strong>
                {{ $hike->rating }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Group:</strong>
                @if($hike->group != null)
                    {{ $hike->group->name }}
                @else
                    No group
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created by:</strong>
                {{ $hike->user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date Created:</strong>
                {{ $hike->created_at }}
            </div>
        </div>

        @if($hike->user->id == Auth::id())
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <a class="btn btn-primary" href="{{ route('hikes.edit',$hike->id) }}">Edit</a>
                </div>
            </div>
        @endif
    </div>
@endsection
