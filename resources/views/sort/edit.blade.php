@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('sorts.update', [$sort]) }}" method="POST">
                    <fieldset>
                        <legend>Update sort</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $sort])
                        @include('layouts.partials.form.text-field', ['name' => 'color', 'type' => 'color', 'model' => $sort])
                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
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
