
@extends("layouts.app")
@section("content")



	


<div class="card text-center">
  <div class="card-header">
    {{$video->title}}
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$video->description}}</h5>
    <video controls id= "video-player">
		<source src="{{route('fileVideo',['filename'=>$video->video_path])}}" type="video/mp4"></source>

		</video>
    
  </div>
  <div class="card-footer text-muted">
    Subido por : {{$video->user->name}}
		a las : {{ \FormatTime::LongTimeFilter($video->created_at) }}
  </div>
</div>

@include("video/comments")

@endsection