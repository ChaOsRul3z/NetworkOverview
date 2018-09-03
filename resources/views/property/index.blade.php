@extends('layouts.admin')

@section('card-body')
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-dark text-white">
            <div class="clearfix">
                <div class="pull-left" style="text-transform: uppercase; font-size: 1.25rem;">Properties</div>
                <div class="pull-right">
                    <a href="{{ route('properties.create') }}" class="btn btn-sm btn-outline-success">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </li>
        <li class="list-group-item list-group-item-primary">
            <div class="row" style="font-size: 0.7em; text-transform: uppercase;">
                <div class="col-md-3">Name</div>
                <div class="col-md-3">PlaceHolder</div>
                <div class="col-md-6"></div>
            </div>
        </li>
        @foreach($properties as $property)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3" style="text-transform: uppercase; font-size: 0.9em; padding-top: 5px;">{{ $property->name }}</div>
                    <div class="col-md-3" style="text-transform: uppercase; font-size: 0.9em; padding-top: 5px;">{{ $property->placeholder }}</div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="pull-right">
                                <a href="{{ route('properties.edit', [$property]) }}" class="btn btn-sm btn-outline-warning">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </a>
                                <button
                                        data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-title="Are you sure you want to delete: {{ $property->name }}?"
                                        data-body="Everything associated with &quot;{{ $property->name }}&quot; will be deleted."
                                        data-url="{{ route('properties.destroy', [$property]) }}"
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
@endsection