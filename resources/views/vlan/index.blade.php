@extends('layouts.admin')

@section('card-body')
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-dark text-white">
            <div class="clearfix">
                <div class="pull-left" style="text-transform: uppercase; font-size: 1.25rem;">@lang('app.vlan.header')</div>
                <div class="pull-right">
                    <a href="{{ route('vlans.create') }}" class="btn btn-sm btn-outline-success">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </li>
        <li class="list-group-item list-group-item-primary">
            <div class="row" style="font-size: 0.7em; text-transform: uppercase;">
                <div class="col-md-6">Name</div>
                <div class="col-md-6"></div>
            </div>
        </li>
        @foreach($vlans as $vlan)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6" style="text-transform: uppercase; font-size: 0.9em; padding-top: 6px;">
                        <span style="font-weight:bold;color: {{ $vlan->color }};" class="fa fa-circle-o"></span>&nbsp;&nbsp;{{ $vlan->name }}
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <div class="pull-right">
                                <a href="{{ route('vlans.edit', [$vlan]) }}" class="btn btn-sm btn-outline-warning">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </a>
                                <button
                                        data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-title="Are you sure you want to delete: {{ $vlan->name }}?"
                                        data-body="Everything associated with &quot;{{ $vlan->name }}&quot; will be deleted."
                                        data-url="{{ route('vlans.destroy', [$vlan]) }}"
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