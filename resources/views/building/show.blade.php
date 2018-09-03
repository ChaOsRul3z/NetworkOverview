@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h5><strong>@lang('app.building.show.header', ['building-name' => $building->name])</strong></h5>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($building->floors as $floor)
                        <li role="presentation" @if($floor == $building->floors->first()) class="active" @endif>
                            <a href="#floor_{{$floor->id}}" aria-controls="floor_{{$floor->id}}" role="tab" data-toggle="tab">{{ $floor->name }}</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach($building->floors as $floor)
                        <div role="tabpanel" @if($floor == $building->floors->first()) class="tab-pane active" @else class="tab-pane" @endif id="floor_{{ $floor->id}}">
                            @if($floor->rooms->count() > 0)
                                <svg viewBox="{{ $floor->viewbox }}">
                                    @foreach($floor->rooms as $room)

                                        <path style="{{ ($room->racks->count() > 0) ? 'fill:#F44336' : 'fill:#FFF' }}" id="room_{{ $room->id }}"
                                            data-room-id="{{ $room->id }}"
                                            title="{{ $room->name }}"
                                            data-floor-id="{{ $floor->id }}"
                                            transform="{{ $room->svg_transform }}"
                                            d="{{ $room->svg_d }}"></path>
                                    @endforeach
                                    <?php $file = "floor.partials.{$floor->id}_borders"; ?>
                                    @include($file)
                                </svg>
                            @else
                                <h4>@lang('app.building.show.empty')</h4>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
