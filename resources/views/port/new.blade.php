@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <form class="form-horizontal" action="{{ route('properties.store') }}" method="POST">
                    <fieldset>
                        <legend>Create property</legend>
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-xs-12">
                                <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        <div class="form-group{{ $errors->has('placeholder') ? ' has-error' : '' }}">
                            <label for="placeholder" class="col-xs-12">
                                <input type="text" class="form-control" name="placeholder" placeholder="placeholder" value="{{ old('placeholder') }}">
                                @if ($errors->has('placeholder'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('placeholder') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-default col-xs-12">Create</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
