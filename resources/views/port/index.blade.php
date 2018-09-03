@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="clearfix">
                        <div class="pull-left">
                            {{ $unit->name}} - Ports
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('rooms.racks.show', [$unit->rack->room, $unit->rack]) }}" class="btn btn-xs btn-info">Back to rack</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($unit->ports->split(3) as $chunk)
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-info">
                                    <div class="row">
                                        <div class="col-md-2 text-center">#</div>
                                        <div class="col-md-3 text-center">LABEL</div>
                                        <div class="col-md-4 text-center">SPEED</div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </li>
                                @foreach($chunk as $port)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 text-center">{{ $loop->index + $loop->parent->index * $chunk->count() + 1 }}</div>
                                        <div class="col-md-3 text-center">{{ $port->label }}</div>
                                        <div class="col-md-4 text-center">{{ $port->getSpeedwithUnit() }}</div>
                                        <div class="col-md-3">
                                            <div class="clearfix">
                                                <div class="pull-right btn-group">
                                                    <a href="{{ route('units.ports.edit', [$unit, $port]) }}" class="btn btn-xs btn-warning">
                                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection