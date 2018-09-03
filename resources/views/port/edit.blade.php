@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('units.ports.update', [$unit, $port]) }}" method="POST">
                    <fieldset>
                        <legend>Edit Port - ({{ $unit->name }})</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        @include('layouts.partials.form.text-field', ['name' => 'label', 'type' => 'text', 'model' => $port])

                        <div class="form-group">
                            <label for="speed" class="col-sm-12">
                                <select class="form-control" name="speed" id="speed">
                                    <option @if($port->speed == 100) selected @endif value="100">100 Mbit</option>
                                    <option @if($port->speed == 1000) selected @endif value="1000">1 Gbit</option>
                                    <option @if($port->speed == 10000) selected @endif value="10000">10 Gbit</option>
                                </select>
                                @if ($errors->has('speed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('speed') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="room" class="col-sm-12">
                                <select class="form-control" name="room" id="room">
                                    <option value="">- Select Room -</option>
                                    @foreach(App\Models\Room::all() as $room)
                                        @if(sizeof($port->room))
                                            <option @if($port->room->first()->id == $room->id) selected @endif value="{{ $room->id }}">{{ $room->name }}</option>
                                        @else
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('speed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('speed') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
