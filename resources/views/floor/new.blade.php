@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('buildings.floors.store', [$building]) }}" method="POST">
                    <fieldset>
                        <legend>Create floor @lang('app.floor.new.legend')</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text'])
                        @include('layouts.partials.form.text-field', ['name' => 'viewbox', 'type' => 'text'])
                        @include('layouts.partials.form.button-field', ['name' => trans('app.floor.new.button')])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
