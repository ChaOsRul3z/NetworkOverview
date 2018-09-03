@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('rooms.racks.update', [$room, $rack]) }}" method="POST">
                    <fieldset>
                        <legend>Update rack</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $rack])
                        @include('layouts.partials.form.text-field', ['name' => 'size', 'type' => 'number', 'model' => $rack])
                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
