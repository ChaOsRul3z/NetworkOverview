@extends('layouts.app')

@section('content')
    <style>
        .content, .title {
            text-align: center
        }

        .content {
            margin: 35% 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table
        }

        .title {
            display: table-cell;
            vertical-align: middle;
            font-size: 42px;
            margin-bottom: 40px
        }
    </style>
    <div class="container">
        <div class="content">
            <div class="title">Be Right Back.</div>
        </div>
    </div>
@endsection
