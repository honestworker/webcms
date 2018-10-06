@extends('front/templateFront')
@section('styles')
    <style>
        .span-style {
            display: inline-block;
            background-color: rgba(120, 169, 148, 0.8);
            width: auto;
            padding: 10px;
            border: none;
            color: #fff;
            position: absolute;
            left: 20px;
            top: 10px;
            text-align: center;
            text-transform: uppercase
        }
    </style>
@endsection

@section('content')

    @include('front/apartments/apartments');

@endsection
