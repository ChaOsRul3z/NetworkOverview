@extends('layouts.admin')

@section('card-header')

@endsection

@section('card-body')
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-dark text-white">
            <div class="clearfix">
                <div class="pull-left" style="text-transform: uppercase; font-size: 1.25rem;">Devices</div>
                <div class="pull-right">
                    <a href="{{ route('devices.create') }}" class="btn btn-sm btn-outline-success">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </li>
    </ul>

    <div id="devices">
        <br>
        <div class="card-columns mr-4 ml-4">
            @foreach($devices as $device)
                <div class="card">
                    <div class="card-header" style="padding-bottom: 5px;">
                        <div class="clearfix">
                            <div class="pull-left text-dark" style="text-transform: uppercase;">
                                <h5 style="margin-top: 0.25rem; margin-bottom: 0;">{{ $device->name }}</h5>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('devices.edit', [$device]) }}" class="btn btn-sm btn-outline-warning">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </a>
                                <button
                                        data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-title="Are you sure you want to delete: {{ $device->name }}?"
                                        data-body="Everything associated with &quot;{{ $device->name }}&quot; will be deleted."
                                        data-url="{{ route('devices.destroy', [$device]) }}"
                                        class="open-DeleteModal btn btn-sm btn-outline-danger">
                                    <span class="fa fa-remove" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span style="font-size: 0.85rem;"><span style="text-transform: uppercase;">Room:&nbsp;</span>{{ $device->room->name }}</span>
                            <br>
                            <span style="font-size: 0.85rem;"><span style="text-transform: uppercase;">Type:&nbsp;</span>{{ $device->type->name }}</span>
                        </li>
                        @if($device->properties->count())
                            <li class="list-group-item list-group-item-primary">
                                properties
                            </li>
                            @foreach($device->properties as $property)
                                <li class="list-group-item">
                                    {{ strtoupper($property->name) }} - {{ $property->getValue() }}
                                </li>
                            @endforeach
                    </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <br>
    {{ $devices->links() }}
    <br>
@endsection

@section('javascript')
    <script>
        $('.pagination').addClass('justify-content-center');
    </script>
@endsection