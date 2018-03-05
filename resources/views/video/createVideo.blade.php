@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <h2>Upload a new video</h2>         
       <hr>
       <form action="{{ route('saveVideo') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
         
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
           
           <div class="form-group">
               <lable for="title">Title</lable>
               <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}"/>
           </div>
           <div class="form-group">
               <lable for="descrption">Description</lable>
               <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
           </div>
           <div class="form-group">
               <lable for="image">Image</lable>
               <input type="file" class="form-control" id="image" name="image" />
           </div>
           <div class="form-group">
               <lable for="video">Video</lable>
               <input type="file" class="form-control" id="video" name="video" />
           </div>
           <button type="submit" class="btn btn-success">Upload Video</button>
       </form>
    </div>
</div>

@endsection
