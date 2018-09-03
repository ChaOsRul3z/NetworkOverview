@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('rooms.racks.store', [$room]) }}" method="POST">
                    <fieldset>
                        <legend>Create rack</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text'])
                        @include('layouts.partials.form.text-field', ['name' => 'size', 'type' => 'number'])
                        @include('layouts.partials.form.button-field', ['name' => 'Create'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
