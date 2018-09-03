@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" id="room_header">
            <div class="col-md-7">
                <div class="float-left" style="margin-left: 20px;">
                    <h3>{{ $room->name }}</h3>
                </div>
            </div>
            <div class="col-md-5">
                <div class="float-right" style="margin-right: 20px;">
                    @if(Auth::check())
                        <a href="{{ route('devices.create', ['room_id' => $room]) }}" class="btn btn-sm btn-outline-success">@lang('app.device.buttons.new')</a>
                        <a href="{{ route('rooms.racks.create', [$room]) }}" class="btn btn-sm btn-outline-success">@lang('app.rack.buttons.new')</a>
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

        <div style="text-align: center;">
            <h4>No racks or devices found.</h4>
        </div>
    </div>
@endsection