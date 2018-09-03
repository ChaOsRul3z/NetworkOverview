@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row" id="room_header">
                <div class="col-md-8">
                    <div class="float-left" style="margin-left: 20px;">
                        <h3>{{ $room->name }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="float-right" style="margin-right: 20px;">
                        @if(Auth::check())
                            <a href="{{ route('devices.create', ['room_id' => $room]) }}" class="btn btn-sm btn-outline-success">@lang('app.device.buttons.new')</a>
                            <a href="{{ route('floors.rooms.edit', [$room->floor, $room]) }}" class="btn btn-sm btn-outline-warning">@lang('app.room.buttons.edit')</a>
                            <button data-toggle="modal"
                                    data-target="#DeleteModal"
                                    data-title="Are you sure you want to delete: {{ $room->name }}?"
                                    data-body="Everything in this room will be deleted."
                                    data-url="{{ route('floors.rooms.destroy', [$room->floor, $room]) }}"
                                    class="open-DeleteModal btn btn-sm btn-outline-danger">@lang('app.room.buttons.delete')
                            </button>
                            @include('layouts.partials.modals.delete')
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <hr style="margin-top:0">
                </div>
            </div>

            @if($room->ports->count())
                <div>
                    @foreach($room->ports as $port)
                        <?php
                        $unit = $port->unit;
                        $rack = $unit->rack;
                        $room = $rack->room;
                        $building = $room->floor->building;
                        ?>
                        <a href="{{ route('rooms.racks.show', [$room, $rack]) }}" class="btn btn-sm btn-info">
                            {{ $building->name }} - {{ $room->name }} - {{ $rack->name }} - {{ $unit->name }} - {{ $port->label }}
                        </a>
                    @endforeach
                    <hr>
                </div>
            @endif

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="clearfix">
                        <div class="pull-left" style="text-transform: uppercase;">@lang('app.device.header')</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-columns">
                        @foreach($room->devices as $device)
                            <div class="card">
                                <div class="card-header" style="padding-bottom: 5px;">
                                    <div class="clearfix">
                                        <div class="pull-left text-dark" style="text-transform: uppercase;">
                                            <h5 style="margin-top: 0.3rem;">{{ $device->name }}</h5>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('devices.edit', [$device]) }}" class="btn btn-sm btn-outline-warning">
                                                <span class="fa fa-pencil" aria-hidden="true"></span>
                                            </a>
                                            <button
                                                    data-toggle="modal"
                                                    data-target="#DeleteModal"
                                                    data-title="Are you sure you want to delete: {{ $device->name }}?"
                                                    data-body="Everything associated with &quot;{{ $device->name }}&quot; will be deleted."
                                                    data-url="{{ route('devices.destroy', [$device]) }}"
                                                    class="open-DeleteModal btn btn-sm btn-outline-danger">
                                                <span class="fa fa-remove" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if($device->properties->count())
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item list-group-item-primary">
                                            properties
                                        </li>
                                        @foreach($device->properties as $property)
                                            <li class="list-group-item">
                                                {{ strtoupper($property->name) }} - {{ $property->getValue() }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection