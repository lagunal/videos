@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <div class="col-md-4">
                <h2>Busqueda: {{ $search }}</h2>
            </div>
            <br />
            <div class="col-md-8" >
                <form class="col-md-3 pull-right" action="{{ url('/search/'.$search) }}" method="get">
                    <label for="filter">Order</label>
                    <select name="filter" class="form-control">
                        <option value="new">Newer first</option>
                        <option value="old">Older first</option>
                        <option value="alfa">From A to Z</option>
                    </select>

                    <input type="submit" value="Sort" class="btn-filter btn btn-sm btn-primary">
                </form>
            </div>
            <div class="clearfix"></div>
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



