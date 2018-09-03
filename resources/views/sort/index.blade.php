@extends('layouts.admin')

@section('card-body')
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-dark text-white">
            <div class="clearfix">
                <div class="pull-left" style="text-transform: uppercase; font-size: 1.25rem;">Sorts</div>
                <div class="pull-right">
                    <a href="{{ route('sorts.create') }}" class="btn btn-sm btn-outline-success">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </li>

        <div id="accordion" role="tablist">
            @foreach($sorts as $sort)
                <div class="card" style="@if(!$loop->last) border-radius: 0; @else border-bottom: none; @endif border-left: none; border-right: none; border-top: none;">
                    <div class="card-header" role="tab" id="heading_{{ $sort->id }}" style="border-bottom: none; border-radius: 0;">
                        <a data-toggle="collapse" href="#collapse_{{ $sort->id }}" aria-expanded="true" aria-controls="collapseOne">
                            <div class="clearfix">
                                <div class="pull-left text-dark" style="text-transform: uppercase; font-size: 0.9em; padding-top: 6px;">
                                    <span style="font-weight:bold;color: {{ $sort->color }};" class="fa fa-circle-o"></span>&nbsp;&nbsp;{{ $sort->name }}: types
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('sorts.types.create', [$sort]) }}" class="btn btn-sm btn-outline-success">
                                        <span class="fa fa-plus" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('sorts.edit', [$sort]) }}" class="btn btn-sm btn-outline-warning">
                                        <span class="fa fa-pencil" aria-hidden="true"></span>
                                    </a>
                                    <button
                                            data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-title="Are you sure you want to delete: {{ $sort->name }}?"
                                            data-body="Everything associated with &quot;{{ $sort->name }}&quot; will be deleted."
                                            data-url="{{ route('sorts.destroy', [$sort]) }}"
                                            class="open-DeleteModal btn btn-sm btn-outline-danger">
                                        <span class="fa fa-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>

                    @if($sort->types->count())
                        <div id="collapse_{{ $sort->id }}" class="collapse @if($loop->first) show @endif" role="tabpanel" aria-labelledby="heading_{{ $sort->id }}" data-parent="#accordion">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-primary">
                                    <div class="row" style="font-size: 0.7em; text-transform: uppercase;">
                                        <div class="col-md-3">NAME</div>
                                        <div class="col-md-3">BRAND</div>
                                        <div class="col-md-2 text-center">UNIT HEIGHT</div>
                                        <div class="col-md-2 text-center">PORT COUNT</div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </li>
                                @foreach($sort->types as $type)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-3" style="padding-top: 5px;">{{ $type->name }}</div>
                                            <div class="col-md-3" style="padding-top: 5px;">{{ $type->brand }}</div>
                                            <div class="col-md-2 text-center" style="padding-top: 5px;">
                                                @if($type->unit_height)
                                                    {{ $type->unit_height }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="col-md-2 text-center" style="padding-top: 5px;">
                                                @if($type->port_count)
                                                    {{ $type->port_count }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <div class="clearfix">
                                                    <div class="pull-right">
                                                        <a href="{{ route('sorts.types.edit', [$sort, $type]) }}" class="btn btn-sm btn-outline-warning">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                        </a>
                                                        <button
                                                                data-toggle="modal"
                                                                data-target="#DeleteModal"
                                                                data-title="Are you sure you want to delete: {{ $sort->name }}?"
                                                                data-body="Everything associated with &quot;{{ $sort->name }}&quot; will be deleted."
                                                                data-url="{{ route('sorts.types.destroy', [$sort, $type]) }}"
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
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </ul>
@endsection