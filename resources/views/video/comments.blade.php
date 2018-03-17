@if(isset($video->comments))
<hr />
<h4>Comments</h4>
<hr />
@endif

@if(session('message'))
   <div class="alert alert-success">
       {{ session('message') }}
   </div>
@endif
@if(Auth::check())
    <form class="col-md-4" action="{{ url('/comment') }}" method="post">
        {!! csrf_field() !!}
        
        <input type="hidden" name="video_id" value="{{ $video->id }}" required />
        <p>
            <textarea class="form-control" name="body" required></textarea>
        </p>
        <input type="submit" value="Comment" class="btn btn-success" />
            
    </form>
    <div class="clearfix"></div>
    <hr />
@endif

@if(isset($video->comments))
    <div class="comment-list">
         @foreach($video->comments as $comment)
             <div class="comment-item col-md-12 pull-left">
                <div class="panel panel-default commment-data">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>{{ $comment->user->name . ' ' . $comment->user->surname }}</strong> {{ FormatTime::LongTimeFilter($comment->created_at) . ' ago.' }}
                        </div>
                    </div> 
                    <div class="panel-body">
                        {{ $comment->body }}
                        @if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()-id == $video->user_id))
                            <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                            <div class="pull-right">
                                <a href="#LudModal{{$comment->id}}" role="button" class="btn btn-md btn-primary" data-toggle="modal">Delete</a>
                                  
                                <!-- Modal / Ventana / Overlay en HTML -->
                                <div id="LudModal{{$comment->id}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Confirm</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you want to delete comment?</p>
                                                <p class="text-warning"><small>{{ $comment->body }}</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <a href="{{ url('/delete-comment/' . $comment->id) }}" type="button" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                
                            </div>
                        @endif
                        
                    </div>
                </div>
                
             </div>
          @endforeach     
    </div>
@endif