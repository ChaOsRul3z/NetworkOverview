@extends('layouts.app')

@section('content')
    <div class="container">
        @include('room.partials.header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <ul class="nav nav-tabs card-header-tabs">
                                @foreach($room->racks as $rackNav)
                                    <li class="nav-items">
                                        <a href="{{ route('rooms.racks.show', [$room, $rackNav]) }}" class="nav-link @if($rackNav->id === $rack->id){{ 'active' }}@endif">
                                            {{ $rackNav->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="float-right">
                            @if(Auth::check())
                                <button class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseUnits"
                                        aria-expanded="false" aria-controls="collapseUnits">Show Units
                                </button>
                                <a href="{{ route('racks.units.create', [$rack]) }}" class="btn btn-sm btn-outline-success">New Unit</a>
                                <a href="{{ route('rooms.racks.edit', [$room, $rack]) }}" class="btn btn-sm btn-outline-warning">Edit Rack</a>
                                <button data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-title="Are you sure you want to delete: {{ $rack->name }}?"
                                        data-body="Everything in this rack will be deleted."
                                        data-url="{{ route('rooms.racks.destroy', [$room, $rack]) }}"
                                        class="open-DeleteModal btn btn-sm btn-outline-danger">Delete Rack
                                </button>
                                @include('layouts.partials.modals.delete')
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Auth::check())
                            @include('unit.partials.table')
                        @endif
                        @include('rack.partials.body')
                    </div>
                </div>
            </div>
            @if(Auth::check())
                <div class="test-box">
                    <div id="createPatchCableSection">
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="portA">ID: <span></span></div>
                            </div>
                            <div class="col-md-6">
                                <div class="portB">ID: <span></span></div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <button type="button" disabled="true" class="col-md-12 btn btn-default btn-sm" id="createPatchCable" href="#">Create</button>
                                <hr>
                            </div>
                            <div class="col-md-12">status:&nbsp;<span id="status"></span>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div id="patchCableVisibilitySection">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" id="toggle">
                                    Patchcable visibility: <br>
                                    <input type="range" min="0" max="2" value="1" step="1" class="slider" id="patchcable-range"><br>
                                    <div class="row" style="padding: 0 3px;">
                                        <span class="col" style="text-align: left;">0%</span>
                                        <span class="col" style="text-align: center;">50%</span>
                                        <span class="col" style="text-align: right;">100%</span>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div id="deletePatchCableSection">
                        <p>Delete Patchcable</p>
                        <p>selected: <span id="patchcableId">-</span></p>
                        <hr>
                        <button type="button" disabled="true" class="col-md-12 btn btn-default btn-sm" id="deletePatchCable" href="#">Delete</button>
                        <hr>
                    </div>
                </div>
                <div class="vlans-legend">
                    @foreach($vlans as $vlan)
                        <span style="font-weight:bold;color: {{ $vlan->color }};" class="fa fa-circle-o"></span>&nbsp;&nbsp;{{ $vlan->name }}<br>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
