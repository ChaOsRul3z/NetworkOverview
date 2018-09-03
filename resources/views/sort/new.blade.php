@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('sorts.store') }}" method="POST">
                    <fieldset>
                        <legend>Create sort</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text'])
                        @include('layouts.partials.form.text-field', ['name' => 'color', 'type' => 'color'])
                        @include('layouts.partials.form.button-field', ['name' => 'Create'])
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
