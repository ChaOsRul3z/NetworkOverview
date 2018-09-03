@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('sorts.types.update', [$sort, $type]) }}" method="POST">
                    <fieldset>
                        <legend>Update type</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $type])
                        @include('layouts.partials.form.text-field', ['name' => 'brand', 'type' => 'text', 'model' => $type])
                        @include('layouts.partials.form.text-field', ['name' => 'unit_height', 'type' => 'number', 'model' => $type])
                        @include('layouts.partials.form.text-field', ['name' => 'port_count', 'type' => 'number', 'model' => $type])
                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
