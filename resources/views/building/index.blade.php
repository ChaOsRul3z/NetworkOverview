@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 style="padding-top: 7px;">@lang('app.building.header')</h5>
                        </div>
                        @if(Auth::check())
                            <div class="float-right">
                                <a href="{{ route('buildings.create') }}" class="btn btn-outline-success">@lang('app.building.buttons.new')</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if($buildings->count() > 0)
                            <svg id="gebouwen" viewBox="-125 30 1200 760">
                                @foreach($buildings as $building)
                                    <g id="building_{{ $building->id }}" data-href="{{ route('buildings.floors.show', [$building, $building->floors->first()]) }}"
                                       data-title="{{ $building->name }}">
                                        {!! $building->paths !!}
                                    </g>
                                @endforeach
                                @include('building.partials._borders')
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
