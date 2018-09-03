@extends('layouts.app')

@section('content')
    <div class="container">
        @include('building.partials.header')
        <div class="row">
            <div class="col-md-12">
                @foreach($floors as $floor)
                    <svg viewBox="{{ $floor->viewbox }}">
                        @foreach($floor->rooms as $room)
                            <g id="room_{{ $room->id }}" style="<?php if ($room->racks->count() > 0) echo "fill:#F44336";  ?>" data-href="{{ route('rooms.racks.show', [$room, $room->racks->first()]) }}" title="{{ $room->name }}">
                                {!! $room->paths !!}
                            </g>
                        @endforeach
                        <?php $file = "floor.partials.borders.{$floor->id}_borders"; ?>
                        @if (View::exists($file))
                            @include($file)
                        @endif
                    </svg>
                @endforeach
            </div>
            <div class="col-sm-12 text-center">
                <h4>@lang('app.floor.empty')</h4>
            </div>
        </div>
    </div>
@endsection
