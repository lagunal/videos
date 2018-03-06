@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing .

                </div>
            </div>
        </div>
    </div>
</div>-->
<!--<iframe id="video-background" width="560" height="315" src="//www.youtube.com/embed/Xxus7tBHxtc?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1&amp;html5=1&amp;allowfullscreen=true&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>-->
<!--<div class="homepage-hero-module">
    <div class="video-container">
        <div class="filter"></div>
        <video autoplay loop class="fillWidth">
            <source src="/images/Rainy_Street.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
            <source src="/images/Rainy_Street.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
        </video>
        <div class="poster hidden">
            <img src="/images/Rainy_Street.jpg" alt="">
        </div>
    </div>
</div>-->

<video poster="/images/Rainy_Street.jpg" id="bgvid" playsinline autoplay muted loop>
      <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
    <source src="/images/Rainy_Street.webm" type="video/webm">
    <source src="/images/Rainy_Street.mp4" type="video/mp4">
</video>
<div id="polina">
    <h1>Videos App</h1>
    <p>Powered by Ludwing Laguna
    <p>Aenean pharetra convallis pellentesque. Vestibulum et metus lectus. Nunc consectetur, ipsum in viverra eleifend, erat erat ultricies felis, at ultricies mi massa eu ligula. Suspendisse in justo dapibus metus sollicitudin ultrices id sed nisl.</p>
    <button><a href="{{ url('/home') }}">Browse Videos</a></button>
</div>

@endsection


     

