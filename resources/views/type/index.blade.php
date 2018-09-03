@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <div class="pull-left">Sorts</div>
                            @if(Auth::check())
                                <div class="pull-right">
                                    <a href="{{ route('sorts.create') }}" class="btn btn-success btn-xs">New Sort</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sorts as $sort)
                                    <tr>
                                        <td style="width:30%;">{{ $sort->name }}</td>
                                        <td style="width:30%;">{{ $sort->color }}</td>
                                        <td style="width:40%;" class="clearfix">
                                            <div class="pull-right btn-group">
                                                <a href="{{ route('sorts.edit', [$sort]) }}" class="btn btn-xs btn-warning">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>
                                                <button data-toggle="modal"
                                                    data-target="#DeleteModal"
                                                    data-title="Are you sure you want to delete: {{ $sort->name }}?"
                                                    data-body="Everything associated with &quot;{{ $sort->name }}&quot; will be deleted."
                                                    data-url="{{ route('sorts.destroy', [$sort]) }}"
                                                    class="open-DeleteModal btn btn-xs btn-danger">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @include('layouts.partials.modals.delete')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
