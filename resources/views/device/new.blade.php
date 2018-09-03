@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('devices.store') }}" method="POST">
                    <fieldset>
                        <legend>Create device</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text'])
                        <div class="form-group">
                            <label for="name" class="col-sm-12">
                                <select class="form-control" name="room_id" id="room_id">
                                    @foreach(App\Models\Room::all()->load('floor.building') as $room)
                                        <option @if (isset($_GET['room_id']) && $_GET['room_id'] == $room->id) selected @endif value="{{ $room->id }}">{{ $room->floor->building->name }} - {{ $room->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('room_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('room_id') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-12">
                                <select class="form-control" name="type_id" id="type_id">
                                    @foreach(App\Models\Type::where('unit_height', '=', '0')->get()->load('sort') as $type)
                                        <option value="{{ $type->id }}">{{ $type->sort->name }} - {{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        {{-- PROPERTIES --}}
                        <?php //$propertiesList = App\Models\Property::all(); ?>
                        {{--<div class="row">--}}
                            {{--<div class="col-md-10"><h4>Properties</h4></div>--}}
                            {{--<div class="col-md-2">--}}
                                {{--<div class="clearfix" style="margin-right: 15px;">--}}
                                    {{--<div class="pull-right">--}}
                                        {{--<a id="addProperty" class="btn btn-sm btn-outline-success">--}}
                                            {{--<span class="fa fa-plus" aria-hidden="true" style="color: #28a745;"></span>--}}
                                            {{--<style>--}}
                                                {{--#addProperty:hover span.fa-plus {--}}
                                                    {{--color: #fff !important;--}}
                                                {{--}--}}
                                                {{--.deleteProperty span.fa-remove {--}}
                                                    {{--color: #dc3545;--}}
                                                {{--}--}}

                                                {{--.deleteProperty:hover span.fa-remove {--}}
                                                    {{--color: #fff !important;--}}
                                                {{--}--}}
                                            {{--</style>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div id="properties" data-count="0">--}}
                        {{--</div>--}}

                        @include('layouts.partials.form.button-field', ['name' => 'Create'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
