@extends('layouts.admin')

@section('card-header')

@endsection

@section('card-body')
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-dark text-white">
            <div class="clearfix">
                <div class="pull-left" style="text-transform: uppercase; font-size: 1.25rem;">Patchcables</div>
                <div class="pull-right">
                    <a href="{{ route('vlans.create') }}" class="btn btn-sm btn-outline-success">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </li>
        <li class="list-group-item list-group-item-primary">
            <div class="row" style="font-size: 0.7em; text-transform: uppercase; padding-top: 5px;">
                <div class="col-md">Unit A</div>
                <div class="col-md">Speed</div>
                <div class="col-md">Vlans</div>
                <div class="col-md">Unit B</div>
                <div class="col-md">Speed</div>
                <div class="col-md">Vlans</div>
                <div class="col-md"></div>
            </div>
        </li>
        @foreach($patchcables as $patchcable)
            <li class="list-group-item">
                    <div class="row">
                        <div class="col-md" style="padding-top: 6px;">{{ $patchcable->portA->unit->name }}</div>
                        <div class="col-md" style="padding-top: 6px;">{{ $patchcable->portA->getSpeedwithUnit() }}</div>
                        <div class="col-md" style="padding-top: 6px;">
                            @foreach($patchcable->portA->vlans->take(6) as $vlan)
                                    <span data-toggle="tooltip" data-placement="left" title="{{ $vlan->name }}"
                                          style="font-size: 1.25rem; font-weight:bold;color: {{ $vlan->color }};" class="fa fa-circle-o"></span>
                            @endforeach
                        </div>
                        <div class="col-md" style="padding-top: 6px;">{{ $patchcable->portB->unit->name }}</div>
                        <div class="col-md" style="padding-top: 6px;">{{ $patchcable->portB->getSpeedwithUnit() }}</div>
                        <div class="col-md" style="padding-top: 6px;">
                            @foreach($patchcable->portB->vlans->take(6) as $vlan)
                                <span data-toggle="tooltip" data-placement="left" title="{{ $vlan->name }}"
                                      style="font-size: 1.25rem; font-weight:bold;color: {{ $vlan->color }};" class="fa fa-circle-o"></span>
                            @endforeach
                        </div>
                        <div class="col-md">
                            <div class="clearfix">
                                <div class="pull-right">
                                    <a href="{{ route('patchcables.edit', [$patchcable]) }}" class="btn btn-sm btn-outline-warning">
                                        <span class="fa fa-pencil" aria-hidden="true"></span>
                                    </a>
                                    <button
                                            data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-title="Are you sure you want to delete: {{ $patchcable->name }}?"
                                            data-body="Everything associated with &quot;{{ $patchcable->name }}&quot; will be deleted."
                                            data-url="{{ route('patchcables.destroy', [$patchcable]) }}"
                                            class="open-DeleteModal btn btn-sm btn-outline-danger">
                                        <span class="fa fa-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </li>
        @endforeach
    </ul>
    <br>
    {{ $patchcables->links() }}
    <br>
@endsection

@section('javascript')
    <script>
        $('.pagination').addClass('justify-content-center');
    </script>
@endsection