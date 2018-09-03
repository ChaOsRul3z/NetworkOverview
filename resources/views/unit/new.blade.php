@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('racks.units.store', [$rack]) }}" method="POST">
                    <fieldset>
                        <legend>Create unit</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text'])
                        <div class="form-group">
                            <label for="name" class="col-sm-12">
                                <select name="type_id" id="" class="form-control">
                                    <option value="">---</option>
                                    @foreach($types as $type)
                                        @if(($rack->units_used + $type->unit_height) < $rack->size)
                                            <option value="{{ $type->id }}">{{ $type->sort->name }} | {{ $type->name }} | size: {{ $type->unit_height }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>
                        @include('layouts.partials.form.button-field', ['name' => 'Create'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
