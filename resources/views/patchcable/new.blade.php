@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form class="form-horizontal" action="{{ route('patchcables.store') }}" method="POST">
                    <h3>Create Patchcable</h3>
                    <hr>
                    {{ csrf_field() }}

                    @include('patchcable.partials.portSelect', ['header' => 'Port A', 'name' => 'A'])
                    @include('patchcable.partials.portSelect', ['header' => 'Port B', 'name' => 'B'])
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-default col-xs-12">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection