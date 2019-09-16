@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>


            @if(auth()->check())
                <div class="col-md-8 pt-lg-4">
                    <form method="post" action="{{ $thread->path() . '/replies'}}">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Have something to say"></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Post</button>
                    </form>
                </div>
            @else
                <div class="col-md-8 pt-lg-4 text-center">
                    <p>Please <a href="{{route('login')}}">sign in</a>  to discussion. </p>
                </div>
            @endif

        </div>
    </div>
@endsection
