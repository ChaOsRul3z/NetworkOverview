@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(Auth::check())
                <div class="col-sm-12">
                    <fieldset>
                        <legend>
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h3 style="margin: 0 0 15px 0">{{ $floor->name }}</h3>
                                </div>
                                <div class="pull-right">
                                    @if(Auth::check())
                                        <div class="btn-group">
                                            <a href="{{ route('floors.rooms.create', [$floor]) }}" class="btn btn-sm btn-success">@lang('app.room.buttons.new')</a>
                                            <a href="{{ route('buildings.floors.edit', [$floor->building, $floor]) }}" class="btn btn-sm btn-warning">@lang('app.floor.buttons.edit')</a>
                                            <button data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-title="Are you sure you want to delete: {{ $floor->name }}?"
                                            data-body="Everything on this floor will be deleted!"
                                            data-url="{{ route('buildings.floors.destroy', [$floor->building, $floor]) }}"
                                            class="open-DeleteModal btn btn-sm btn-danger">@lang('app.floor.buttons.delete')
                                        </button>
                                    </div>
                                    @include('layouts.partials.modals.delete')
                                @endif
                            </div>
                        </div>
                    </legend>
                </fieldset>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <h4>No rooms found</h4>
        </div>
    </div>
</div>
@endsection
