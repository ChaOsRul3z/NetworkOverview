@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('properties.update', [$property]) }}" method="POST">
                    <fieldset>
                        <legend>Update property</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $property])
                        @include('layouts.partials.form.text-field', ['name' => 'placeholder', 'type' => 'text', 'model' => $property])
                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
