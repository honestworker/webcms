@extends('front/templateFront')
@section('content')

    @include('front/module/welcome_section');
    @include('front/module/online_book_section');
    @include('front/module/best_place_section');
    @include('front/module/hotel_room_section');
    @include('front/module/facilities_section');
    @include('front/module/gallery_section');
    @include('front/module/blog_post_section');

@endsection
