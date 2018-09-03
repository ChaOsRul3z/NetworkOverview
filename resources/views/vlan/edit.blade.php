@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('vlans.update', [$vlan]) }}" method="POST">
                    <fieldset>
                        <legend>@lang('app.vlan.edit.legend')</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $vlan])
                        @include('layouts.partials.form.text-field', ['name' => 'number', 'type' => 'number', 'model' => $vlan])
                        @include('layouts.partials.form.text-field', ['name' => 'color', 'type' => 'color', 'model' => $vlan])
                        @include('layouts.partials.form.button-field', ['name' => trans('app.vlan.edit.button')])
                    </fieldset>
                    <style>
                        input[type=color] {
                            height: 36px;
                        }
                    </style>
                </form>
            </div>
        </div>
    </div>
@stop
