@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link {{{ (Request::is('sorts') ? 'active' : '') }}}" href="{{ route('sorts.index') }}">@lang('app.menu.sorts')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ (Request::is('properties') ? 'active' : '') }}}" href="{{ route('properties.index') }}">@lang('app.menu.properties')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ (Request::is('vlans') ? 'active' : '') }}}" href="{{ route('vlans.index') }}">@lang('app.menu.vlans')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ (Request::is('patchcables') ? 'active' : '') }}}" href="{{ route('patchcables.index') }}">@lang('app.menu.patchcables')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{{ (Request::is('devices') ? 'active' : '') }}}" href="{{ route('devices.index') }}">@lang('app.menu.devices')</a>
                            </li>
                        </ul>
                    </div>
                    {{-- TEST START --}}
                    @yield('card-body')
                    {{-- TEST END--}}
                </div>
            </div>
        </div>
        @include('layouts.partials.modals.delete')
    </div>
@endsection