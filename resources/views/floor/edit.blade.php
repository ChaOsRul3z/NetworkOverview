@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('buildings.floors.update', [$building, $floor]) }}" method="POST">
                    <fieldset>
                        <legend>@lang('app.floor.edit.legend')</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $floor])
                        @include('layouts.partials.form.text-field', ['name' => 'viewbox', 'type' => 'text', 'model' => $floor])
                        @include('layouts.partials.form.button-field', ['name' => trans('app.floor.edit.button')])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
