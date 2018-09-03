@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content error-page__content">
            <div class="title error-page__title">You are not allowed to perform this action.{{ var_dump(Auth::check()) }} </div>

        </div>
    </div>
@stop
