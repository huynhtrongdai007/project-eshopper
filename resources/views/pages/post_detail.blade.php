@extends('master')
@section('content')
@include('pages.blocks.left-sidebar')

<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            <h3>Girls Pink T Shirt arrived in store</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i>{{$post->users->name}}</li>
                    <li><i class="fa fa-clock-o"></i>{{date('H:i:s', strtotime($post->created_at))}}</li>
                    <li><i class="fa fa-calendar"></i>{{date('d-M-Y', strtotime($post->created_at))}}</li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
                <img src="{{$post->feature_image_path}}" alt="">
            </a>
            <p>
                {!!$post->content!!}
            </p>
            
            <div class="pager-area">
                <ul class="pager pull-right">
                   {{$paginates->links()}}
                </ul>
            </div>
         
            
        </div>
    </div><!--/blog-post-area-->

    <div class="rating-area">
        <ul class="ratings">
            <li class="rate-this">Rate this item:</li>
            <li>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
            <li class="color">(6 votes)</li>
        </ul>
        <ul class="tag">
            <li>TAG:</li>
            @foreach ($post_tags as $postTags)
            <li><a class="color" href="{{ route('post-tags', ['id'=>$postTags->id]) }}">{{$postTags->name}}<span>/</span></a></li>
            @endforeach

        </ul>
    </div><!--/rating-area-->

    <div class="socials-share">
                    <a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>

    </div><!--/socials-share-->

    <div class="media commnets">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{ asset('frontend/images/blog/man-one.jpg') }}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Annie Davis</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="blog-socials">
                <ul>
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                </ul>
                <a class="btn btn-primary" href="">Other Posts</a>
            </div>
        </div>
    </div><!--Comments-->
    <div class="response-area">
        <h2><span id="respones"></span> RESPONSES</h2>
        <ul class="media-list">
            <div id="display_comment"></div>
        </ul>					
    </div><!--/Response-area-->
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-4">
                <h2>Leave a replay</h2>
                <form id="form-comment">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <input type="text" name="name" id="name" placeholder="write your name...">
                    <div class="blank-arrow">
                        <label>Email Address</label>
                    </div>
                    <span>*</span>
                    <input type="email" name="email" id="email" placeholder="your email address...">

            </div>
            <div class="col-sm-8">
                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Comment</label>
                    </div>
                    <span>*</span>
                    <textarea name="comment" id="comment"  rows="11"></textarea>
                    <input type="hidden" name="parent_id" id="parent_id" value="0" />
                    <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}" />
                    <input type="submit" class="btn btn-primary" id="btn-post-comment" value="post comment">
                    
                </form>
                </div>
            </div>
        </div>
    </div><!--/Repaly Box-->
</div>
@endsection
@section('script')
<script>

</script>
@endsection
