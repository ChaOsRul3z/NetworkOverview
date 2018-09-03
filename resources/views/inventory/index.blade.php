@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 128px;">
        <div class="row">
            <div class="offset-md-1 col-md-10">
                <div class="accordion" id="searchForm">
                    <div class="card">
                        <div class="card-header" id="searchFormHeading">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#searchFormCollapse" aria-expanded="true" aria-controls="searchFormCollapse">
                                    Search
                                </button>
                            </h5>
                        </div>

                        <div id="searchFormCollapse" class="collapse show" aria-labelledby="searchFormHeading" data-parent="#searchForm">
                            <div class="card-body">
                                <form action="{{ route('inventory-search')  }}" method="post">
                                    {{ csrf_field() }}
                                    {{-- TODO FIX DATA BEING POSTED TO INVENTORY CONTROLLER SEARCH --}}
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="device name">
                                    </div>
                                    <div class="form-group">
                                        <label for="date-from">Date From</label>
                                        <input type="date" class="form-control" id="date-from" name="date-from" placeholder="from">
                                    </div>
                                    <div class="form-group">
                                        <label for="date-to">Date To</label>
                                        <input type="date" class="form-control" id="date-to" name="date-to" placeholder="to">
                                    </div>
                                    <div class="form-group">
                                        <label for="date-to">Type</label>
                                        <br>
                                        <a id="deselect-types" class="btn btn-secondary btn-sm" style="margin-bottom: 5px;">Deselect All</a>
                                        <select multiple class="form-control" id="types" name="types[]" style="height: 80px;">
                                            @foreach(App\Models\Type::all() as $type)
                                                @if($type->devices->count())
                                                    <option value="{{ $type->id }}">{{ $type->sort->name }} - {{ $type->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="date-to">Room</label>
                                        <br>
                                        <a id="deselect-rooms" class="btn btn-secondary btn-sm" style="margin-bottom: 5px;">Deselect All</a>
                                        <select multiple class="form-control" id="rooms" name="rooms[]" style="height: 80px;">
                                            @foreach(App\Models\Room::all() as $room)
                                                @if($room->devices->count())
                                                    <option value="{{ $room->id }}">{{ $room->floor->building->name }} - {{ $room->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12" style="margin-top: 10px;">
                @if(session()->has('devices'))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>room</th>
                            <th>type</th>
                            <th>created</th>
                        </tr>
                        </thead>
                        <tbody id="devices">
                        @foreach(session()->get('devices') as $device)
                            <tr>
                                <td>{{ $device->name }}</td>
                                <td>{{ $device->room->name }}</td>
                                <td>{{ $device->type->name }}</td>
                                <td>{{ $device->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <style>
        @media print {
            #searchForm {
                display: none;
            }
        }
    </style>
@endsection


@section('javascript')
    <script>
        $(document).ready(function () {
            $('#deselect-types').click(function () {
                $('#types option:selected').prop("selected", false);
            });

            $('#deselect-rooms').click(function () {
                $('#rooms option:selected').prop("selected", false);
            });
        });
    </script>
@endsection