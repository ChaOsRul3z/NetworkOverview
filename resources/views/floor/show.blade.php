@extends('layouts.app')

@section('content')
    <div class="container">
        @include('building.partials.header')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <ul class="nav nav-tabs card-header-tabs">
                                @foreach($building->floors as $floorNav)
                                    <li class="nav-item">
                                        <a href="{{ route('buildings.floors.show', ['building' => $building->id, 'floor' => $floorNav->id]) }}"
                                           class="nav-link @if($floorNav->id === $floor->id){{ 'active' }}@endif">
                                            {{ $floorNav->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="float-right">
                            @if(Auth::check())
                                <a href="{{ route('floors.rooms.create', [$floor]) }}" class="btn btn-sm btn-outline-success">@lang('app.room.buttons.new')</a>
                                <a href="{{ route('buildings.floors.edit', [$building, $floor]) }}" class="btn btn-sm btn-outline-warning">@lang('app.floor.buttons.edit')</a>
                                <button data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-title="@lang('app.floor.delete.title', ['floor' => $floor->name])"
                                        data-body="@lang('app.floor.delete.body')"
                                        data-url="{{ route('buildings.floors.destroy', [$building, $floor]) }}"
                                        class="open-DeleteModal btn btn-sm btn-outline-danger">@lang('app.floor.buttons.delete')
                                </button>
                                @include('layouts.partials.modals.delete')
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if($floor->rooms->count() > 0)
                            <div class="col-sm-12">
                                <svg viewBox="{{ $floor->viewbox }}">
                                    @foreach($floor->rooms as $room)
                                        <g id="room_{{ $room->id }}"
                                           class="@if($room->racks->count()){{--
                                           --}}racks{{--
                                           --}}@elseif($room->devices->count()){{--
                                           --}}devices{{--
                                           --}}@else{{--
                                           --}}room{{--
                                           --}}@endif"
                                           data-href="{{ route('floors.rooms.show', [$floor, $room]) }}"
                                           title="{{ $room->name }} {{ $room->number }}">{!! $room->paths !!}
                                        </g>
                                    @endforeach
                                    <?php $file = "floor.partials.borders.{$floor->id}_borders"; ?>
                                    @if (View::exists($file))
                                        @include($file)
                                    @endif
                                </svg>
                            </div>
                        @else
                            <div class="col-sm-12 text-center">
                                <h4>@lang('app.room.empty')</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
