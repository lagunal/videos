@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           <h2>Edit {{ $video->title }}</h2>         
           <hr>
           <form action="{{ route('updateVideo', array('video_id' => $video->id)) }}" method="post" enctype="multipart/form-data" class="col-lg-7">
             
               {!! csrf_field() !!}
               
               @if($errors->any())
                 <div class="alert alert-danger">
                     <ul>
                         @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
               @endif
               <input type="hidden" id="hd_image" name="hd_image" value="{{ $video->image }}" />
               <input type="hidden" id="hd_video" name="hd_video" value="{{ $video->video_path }}" />
               <div class="form-group">
                   <label for="title">Title</label>
                   <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}"/>
               </div>
               <div class="form-group">
                   <label for="descrption">Description</label>
                   <textarea class="form-control" id="description" name="description">{{$video->description}}</textarea>
               </div>
               <div class="form-group">
                   <label for="image">Image</label>
                            @if(Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb">
                                    <div class="video-image-mask">
                                        <img src="{{ url('/image/' . $video->image) }}" class="video-image" />
                                    </div>
                                </div>
                            @endif
                   <input type="file" class="form-control" id="image" name="image" />
               </div>
               <div class="form-group">
                   <label for="video">Video</label>
                        <video controls id="video-player">
                            <source src="{{ route('fileVideo', ['filename' => $video->video_path ]) }}"></source>
                            Browser not HTML5 compatible
                        </video>
                   <input type="file" class="form-control" id="video" name="video" />
               </div>
               <button type="submit" class="btn btn-success">Update Video</button>
           </form>
        </div>
    </div>
@endsection
@section('footer')
    <footer class="col-md-10 col-md-offset-1">
        <hr />
        <p>Powered by Ludwing Laguna, 2018</p>
    </footer>
@endsection
