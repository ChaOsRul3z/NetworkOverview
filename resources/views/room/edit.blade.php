@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('floors.rooms.update', [$floor, $room]) }}" method="POST">
                    <fieldset>
                        <legend>@lang('app.room.edit.legend')</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $room])
                        @include('layouts.partials.form.text-field', ['name' => 'number', 'type' => 'text', 'model' => $room])
                        @include('layouts.partials.form.text-field', ['name' => 'paths', 'type' => 'text', 'model' => $room])
                        @include('layouts.partials.form.button-field', ['name' => trans('app.room.edit.button')])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
