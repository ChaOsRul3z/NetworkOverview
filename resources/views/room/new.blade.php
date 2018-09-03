@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('floors.rooms.store', [$floor]) }}" method="POST">
                    <fieldset>
                        <legend>@lang('app.room.new.legend')</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text'])
                        @include('layouts.partials.form.text-field', ['name' => 'number', 'type' => 'text'])
                        @include('layouts.partials.form.text-field', ['name' => 'paths', 'type' => 'text'])
                        @include('layouts.partials.form.button-field', ['name' => trans('app.room.new.button')])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
