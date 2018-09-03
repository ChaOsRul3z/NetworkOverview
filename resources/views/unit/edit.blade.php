@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-7" style="margin-left: 20%;">
                <form class="form-horizontal" action="{{ route('racks.units.update', [$rack, $unit]) }}" method="POST">
                    <fieldset>
                        <legend>Update unit</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $unit])
                        <div class="form-group">
                            <label for="name" class="col-sm-12">
                                <input type="text" class="form-control" name="type_id" disabled value="{{ $unit->type->name . " - " . $unit->type->sort->name }}">
                            </label>
                        </div>

                        @include('unit.partials.properties')

                        @if($unit->ports->count())
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Ports</h4>
                                    <hr style="margin-top: 0;">
                                </div>
                            </div>

                            <div id="ports">
                                <div class="row">
                                    @foreach($unit->ports->split(2) as $chunk)
                                        <div class="col-md-6">
                                            <ul class="list-group">
                                                <li class="list-group-item list-group-item-info" style="padding: 0.50rem 1.25rem;">
                                                    <div class="row">
                                                        <div class="col-md-2 text-center" style="font-size: 0.80em;">#</div>
                                                        <div class="col-md-3" style="font-size: 0.80em;">LABEL</div>
                                                        <div class="col-md-4" style="font-size: 0.80em;">SPEED</div>
                                                        <div class="col-md-3"></div>
                                                    </div>
                                                </li>
                                                @foreach($chunk as $port)
                                                    <li class="list-group-item" style="padding: 0.50rem 1.25rem;">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center" style="font-size: 0.75em; margin-top: 5px;">{{ $loop->index + $loop->parent->index * $chunk->count() + 1 }}</div>
                                                            <div class="col-md-3" style="font-size: 0.75em; margin-top: 5px;">{{ $port->label }}</div>
                                                            <div class="col-md-4" style="font-size: 0.75em; margin-top: 5px;">{{ $port->getSpeedwithUnit() }}</div>
                                                            <div class="col-md-3">
                                                                <a href="{{ route('units.ports.edit', [$unit, $port]) }}" style="font-size:.675rem;" class="pull-right btn btn-sm btn-outline-warning">
                                                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop