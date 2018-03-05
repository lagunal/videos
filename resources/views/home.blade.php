@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if(session('message'))
               <div class="alert alert-success">
                   {{ session('message') }}
               </div>
            @endif
            @include('video.videosList') 
            
        </div>

    </div>
</div>
@endsection

@section('footer')
    <footer class="col-md-10 col-md-offset-1">
        <hr />
        <p>Powered by Ludwing Laguna, 2018</p>
    </footer>
@endsection
