@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('devices.update', [$device]) }}" method="POST">
                    <fieldset>
                        <legend>Update device</legend>
                        <hr style="margin-top: 0;">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('layouts.partials.form.text-field', ['name' => 'name', 'type' => 'text', 'model' => $device])
                        <div class="form-group">
                            <label for="name" class="col-sm-12">
                                <select class="form-control" name="room_id" id="room_id">
                                    @foreach(App\Models\Room::all()->load('floor.building') as $room)
                                        <option @if($device->room->id === $room->id) selected @endif value="{{ $room->id }}">{{ $room->floor->building->name }} - {{ $room->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('room_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('room_id') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-12">
                                <select class="form-control" name="type_id" id="type_id">
                                    @foreach(App\Models\Type::where('unit_height', '=', '0')->get()->load('sort') as $type)
                                        <option @if($device->type->id === $type->id) selected @endif value="{{ $type->id }}">{{ $type->sort->name }} - {{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>
                        {{-- PROPERTIES --}}
                        <?php $propertiesList = App\Models\Property::all(); ?>
                        <div class="row">
                            <div class="col-md-10"><h4>Properties</h4></div>
                            <div class="col-md-2">
                                <div class="clearfix" style="margin-right: 15px;">
                                    <div class="pull-right">
                                        <a id="addProperty" class="btn btn-sm btn-outline-success">
                                            <span class="fa fa-plus" aria-hidden="true" style="color: #28a745;"></span>
                                            <style>
                                                #addProperty:hover span.fa-plus {
                                                    color: #fff !important;
                                                }

                                                .deleteProperty span.fa-remove {
                                                    color: #dc3545 !important;
                                                }

                                                .deleteProperty:hover span.fa-remove {
                                                    color: #fff !important;
                                                }
                                            </style>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="properties" data-count="{{ $device->properties->count() }}">
                            @foreach($device->properties as $property)
                                <div class="form-group" id="property_{{ $loop->iteration }}">
                                    <label class="col-md-4 pr-2">
                                        Name
                                        <select class="form-control mb-2" name="property_ids[]" id="property_ids">
                                            @foreach($propertiesList as $propertyList)
                                                <option @if($property->id === $propertyList->id) selected @endif value="{{ $propertyList->id }}">{{ strtoupper($propertyList->name) }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <label class="col-md-6" style="max-width:54.1%;">
                                        Value
                                        <input type="text" name="property_values[]" id="property_values" class="form-control" value="{{ old('properties[]', $property->getValue()) }}"">
                                    </label>
                                    <label class="col-md-1">
                                        <a data-id="{{ $loop->iteration }}" class="deleteProperty btn btn-sm btn-outline-danger">
                                            <span class="fa fa-remove" aria-hidden="true"></span>
                                        </a>
                                    </label>
                                    @if ($errors->has('room_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('room_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @include('layouts.partials.form.button-field', ['name' => 'Update'])
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <style>
        #properties .form-group {
            margin-bottom: 0px;
        }
    </style>
@stop

@section('javascript')
    <script>
        let count = 0;
        $('.deleteProperty').click(function () {
            console.log("test");
            let id = $(this).data('id');
            let element = $('#property_' + id);
            element.remove();
        });

        $('#addProperty').click(function () {
            let id = $(this).data('id');
            let list = $('#properties');
            if (count === 0) {
                count = $(list).data('count') + 1;
            } else {
                count++;
            }
            console.log(count);
            let element =
                '<div class="form-group" id="property_' + count + '">' +
                '<label class="col-md-4 pr-2">' +
                'Name' +
                '<select class="form-control mb-2" name="property_ids[]" id="property_ids">' +
                '@foreach($propertiesList as $propertyList)' +
                '<option value="{{ $propertyList->id }}">{{ strtoupper($propertyList->name) }}</option>' +
                '@endforeach' +
                '</select>' +
                '</label>' +
                '<label class="col-md-6" style="max-width:54.1%;">' +
                'Value' +
                '<input type="text" name="property_values[]" id="property_values" class="form-control" value="{{ old('properties[]') }}"">' +
                '</label>' +
                '<label class="col-md-1">' +
                '<a style="margin-left: 10px;" data-id="' + count + '" class="deleteProperty btn btn-sm btn-outline-danger">' +
                '<span class="fa fa-remove" aria-hidden="true"></span>' +
                '</a>' +
                '</label>' +
                '@if ($errors->has('room_id'))' +
                '<span class="help-block">' +
                '<strong>{{ $errors->first('room_id') }}</strong>' +
                '</span>' +
                '@endif' +
                '</div>';
            list.append(element);
            $('.deleteProperty').click(function() {
                let id = $(this).data('id');
                let element = $('#property_' + id);
                element.remove();
            });
        });
    </script>
@endsection