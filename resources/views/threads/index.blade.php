@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Forum Threads
                </div>

                <div class="panel-body">
                @foreach ($threads as $thread)
                    <article>
                        <h4>
                            <a href="{{ $thread->path() }}">
                                {{ $thread->title }}
                            </a>
                        </h4>
                        <p>{{ $thread->body }}</p>
                    </article>
                    <hr>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
