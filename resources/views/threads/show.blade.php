@extends('layouts.app')

@section('content')
<div class="container" style="padding-bottom: 100px">
    
    <div class="row" >
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#">{{$thread->creator->name}}</a> posted:
                    {{$thread->title}}
                </div>
                <div class="panel-body">
                    {{$thread->body}}
                </div>
            </div>

            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach

            {{$replies->links()}}

            @if(auth()->check())
               
               <form method="POST" action=" {{$thread->path(). '/replies' }} ">
                   
                   {{csrf_field()}}
                   
                    <div class="form-group">
                     
                        <textarea placeholder="Have something to say?" name="body" id="body" class="form-control"></textarea>
                    
                    </div>
                
                    <input type="submit" name="submit" value="Post">
               
               </form>
               
                
            @else
                
                  Please <a href="/login">sign in</a> to paticipate in this discussion.
               
            @endif

        </div><!--col-md-8-->

        <div class="col-md-4">
            
            <div class="panel panel-default">
                
                <div class="panel-body">
                    
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="#">{{ $thread->creator->name }}</a> and currently has
                        {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </p>
                
                </div>

            </div>

        </div>

    </div><!--row-->
    
  


</div>
@endsection
