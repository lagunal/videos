<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;



class VideoController extends Controller
{
    public function createVideo(){
        return view('video.createVideo');
    }
    
    //function to save video
    public function saveVideo(Request $request){
        
        //validate form    
        $validateData = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4'
        ]);
        
        try {
                    // video info
                    $video = new Video();
                    $user = \Auth::user();
                    $video->user_id = $user->id;
                    $video->title = $request->input('title');
                    $video->description = $request->input('description');
                    
                    //upload image
                    $image = $request->file('image');
                    if($image){
                        $image_path = time() . $image->getClientOriginalName();
                        \Storage::disk('images')->put($image_path, \File::get($image));
                        $video->image = $image_path;
                    }

                    //upload video
                    $video_file = $request->file('video');
                    if($video_file){
                        $video_path = time() . $video_file->getClientOriginalName();
                        \Storage::disk('videos')->putFile($video_path, \File::get($video_file));
                        $video->video_path = $video_path;
                    }
                    
                    //save to DB
                    $video->save();
                    
        } catch(\Exception $e){
            $message = array('message' => 'Error trying to upload video!. Please Try again.');
            return redirect()->route('home')->with($message);
        }
        
        return redirect()->route('home')->with(array(
                 "message" => 'Video successfully uploaded!!'
        ));
        
        
        
    }
    
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
        
        
    }
    
    public function getVideoDetail($video_id){
        $video = Video::find($video_id);
        return view('video.detail', array(
                'video' => $video
            ));
    }
    
    public function getVideo($filename){
        $file = Storage::disk('videos')->get($filename);
        return new Response($file,200);
    }
    
    //function to delete video
    public function delete($video_id){
        $user = \Auth::user();
        $video = Video::find($video_id );
        $comments = Comment::where('video_id', $video_id)->get();
        
        if($user && $video->user_id == $user->id){
            //delete comments
            if ($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            
            //delete files
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            
            
            //delete DB
            $video->delete();
            
            $message = array('message' => 'Video succesfully deleted');

        }else{
            $message = array('message' => 'Video not deleted');
        }
        
        return redirect()->route('home')->with($message);
        
    }
    
    
    public function edit($id){
        $user = \Auth::user();
        $video = Video::findOrFail($id);
        if($user && $video->user_id == $user->id){
            return view('video.edit' , array('video' => $video));
        }else{
            return redirect('home');
        }
    }
    
    //function to update video
    public function update($video_id, Request $request){
        
       //validate form    
        $validateData = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4,wmv'
        ]);
        
        try{        
                $user = \Auth::user();
                $video = Video::findOrFail($video_id);
                $video->user_id = $user->id;
                $video->title = $request->input('title');
                $video->description = $request->input('description');
        
                //upload image
                $image = $request->file('image');
                
                if($image){
                    //delete old image file
                    Storage::disk('images')->delete($video->image);

                    $image_path = time() . $image->getClientOriginalName();
                    Storage::disk('images')->put($image_path, \File::get($image));
                    $video->image = $image_path;
                    
                }
                
                //upload video
                $video_file = $request->file('video');
                
                if($video_file){
                    //delete old video file
                    Storage::disk('videos')->delete($video->video_path);
                    
                    $video_path = time() . $video_file->getClientOriginalName();
                    Storage::disk('videos')->put($video_path, \File::get($video_file));
                    $video->video_path = $video_path;
                    
                }
        
                $video->update();
        }
        catch(\Exception $e){
                    $message = array('message' => 'Error trying to updating video!. Please Try again.');
                    return redirect()->route('home')->with($message);
        }
        
        return redirect()->route('home')->with(array(
            'message' => 'video updated successfully'
            ));
    }
    
    public function search($search = null, $filter = null){
        
        if(is_null($search)){
            $search = \Request::get('search');
    
            if(is_null($search)){
                return redirect()->route('home');   
            }
    
            return redirect()->route('videoSearch', array(
                'search' => $search
            ));
        }
        
        if(is_null($filter) && \Request::get('filter') && !is_null($search)){
            $filter = \Request::get('filter');
            
            return redirect()->route('videoSearch', array(
                'filter' => $filter,
                'search' => $search
            ));
        }
        //for sort results////////
        $column = "id";
        $order = "desc";
        if(!is_null($filter)){
            switch($filter){
                case 'new':
                    $column = "id";
                    $order = "desc";
                    break;
                case 'old':
                    $column = "id";
                    $order = "asc";
                    break;
                case 'alfa':
                    $column = "title";
                    $order = "asc";
                    break;
            }
        }
        $videos = Video::where('title', 'LIKE', '%'. $search .'%')
                        ->orderBy($column, $order)
                        ->paginate(5);
        
        //call the view
        return view('video.search', array(
            'videos' => $videos,
            'search' => $search
        ));
        
        
    }
    
}

