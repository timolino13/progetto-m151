@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Hike</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hikes.update',$hike->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{$hike->title}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description"
                              placeholder="Description" value="{{$hike->description}}"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Difficulty (0-10):</strong>
                    <input type="number" min="0" max="10" name="difficulty" class="form-control"
                           placeholder="Difficulty" value="{{$hike->difficulty}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Distance (km):</strong>
                    <input type="number" min="0" name="distance" class="form-control" placeholder="Distance" value="{{$hike->distance}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Duration (hh:mm):</strong>
                    <input type="text" name="duration" class="form-control" placeholder="Duration" value="{{$hike->duration}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start location:</strong>
                    <input type="text" name="startLocation" class="form-control" placeholder="Start location" value="{{$hike->startLocation}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>End location:</strong>
                    <input type="text" name="endLocation" class="form-control" placeholder="End location" value="{{$hike->endLocation}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Done:</strong>
                    <select name="done" class="form-control">
                        <option value="{{false}}" @if(!$hike->done) selected @endif>No</option>
                        <option value="{{true}}" @if($hike->done) selected @endif>Yes</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Rating (0-5):</strong>
                    <input type="number" min="0" max="5" step="0.5" name="rating" class="form-control"
                           placeholder="Rating" value="{{$hike->rating}}">
                </div>
            </div>

            @if(count($groups) > 0)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Group:</strong>
                        <select class="form-control" name="group_id">
                            <option value="">No group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}"
                                        @if($group->id == $hike->group_id) selected @endif>{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
