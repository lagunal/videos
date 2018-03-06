@extends('layouts.app')

@section('content')
<div class="col-md-11 col-md-offset-1">
    <h2>{{ $video->title }}</h2>

    <div class="col-md-8">
        <!--video-->
        <video controls id="video-player">
            <source src="{{ route('fileVideo', ['filename' => $video->video_path ]) }}"></source>
            Browser not HTML5 compatible
        </video>
        
        <!--description-->
        <div class="panel panel-default video-data">
            <div class="panel-heading">
                <div class="panel-title">
                    Published by <strong><a href="{{ route('userChannel', ['user_id' => $video->user->id]) }}">{{ $video->user->name . ' ' . $video->user->surname }}</a></strong> {{ FormatTime::LongTimeFilter($video->created_at) . ' ago.' }}
                </div>
            </div> 
            <div class="panel-body">
                {{ $video->description }}
            </div>
        </div>
        <!--coments-->
           @include('video.comments')

    </div> 
</div>
@endsection

