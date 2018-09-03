<div class="row">
    <div class="col-md-7">
        <div class="float-left" style="margin-left: 20px;">
            <h3>{{ $building->name }}</h3>
        </div>
    </div>
    <div class="col-md-5">
        <div class="float-right" style="margin-right: 20px;">
            @if(Auth::check())
                <a href="{{ route('buildings.floors.create', [$building])}}" class="btn btn-sm btn-outline-success">@lang('app.floor.buttons.new')</a>
                <a href="{{ route('buildings.edit', [$building]) }}" class="btn btn-sm btn-outline-warning">@lang('app.building.buttons.edit')</a>
                <button data-toggle="modal"
                        data-target="#DeleteModal"
                        data-title='@lang('app.building.delete.title', ['building' => $building->name])'
                        data-body='@lang('app.building.delete.body')'
                        data-url="{{ route('buildings.destroy', [$building]) }}"
                        class="open-DeleteModal btn btn-sm btn-outline-danger">@lang('app.building.buttons.delete')
                </button>
                @include('layouts.partials.modals.delete')
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <hr style="margin-top:0px;">
    </div>
</div>
