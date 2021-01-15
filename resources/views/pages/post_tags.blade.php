@extends('master')
@section('content')
@include('pages.blocks.left-sidebar')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        @foreach ($posts as $item)
        <div class="single-blog-post">
            <h3>{{$item->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i>{{$item->name}}</li>
                    <li><i class="fa fa-clock-o"></i>{{date('H:i:s', strtotime($item->created_at))}}</li>
                    <li><i class="fa fa-calendar"></i>{{date('d-M-Y', strtotime($item->created_at))}}
                    </li>
                </ul>
                <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="{{ route('post-detail', ['slug'=>$item->slug,'id'=>$item->id]) }}">
                <img src="{{ asset($item->feature_image_path) }}" alt="">
            </a>
            <p>{{$item->description}}</p>
            <a  class="btn btn-primary" href="{{ route('post-detail', ['slug'=>$item->slug,'id'=>$item->id]) }}">Read More</a>
        </div>
        @endforeach
        <div class="pagination-area">
            <ul class="pagination">
                {{ $posts->links() }}
            </ul>
        </div>
    </div>
</div>
@endsection