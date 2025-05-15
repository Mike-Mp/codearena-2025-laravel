@extends('layouts.app')

@section('content')
<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
      <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $post->title }}</h1>
      <p class="mt-6 text-xl/8">{{ $post->description }}</p>
      <img class="aspect-video rounded-xl bg-gray-50 object-cover mt-10" src="{{ $post->image }}" alt="{{ $post->title }}">
      <div class="mt-16 max-w-2xl">
        <p class="mt-6">{{ $post->body }}</p>
      </div>
      <div class="mt-16 font-bold">
        <a href="">{{ $post->author->name }}</a>
      </div>

    <form action="{{ route('comment', $post)  }}" method="POST" id="comment-form" class="flex flex-col gap-5 mt-10">
      @csrf
      <div>Add a comment</div>
      <input class="border rounded-[5px] p-1" value="{{ old('name') }}" type="text" id="name" required name="name" placeholder="Name" 
       />
      @error('name')
        <div>
          {{ $message  }}
        </div>
      @enderror
      <textarea class="border rounded-[5px] p-1 resize-none" name="body" id="body" required placeholder="Body...">{{old('body')}}</textarea> 
      @error('body')
        <div>
          {{$message}}
        </div>
      @enderror
      <button class="border rounded-[5px] w-[80px]" type="submit">Submit</button>
    </form>

    <h3 class="mt-5 border-t">Comments</h3>
    <div class="pl-5">
    @forelse ($comments as $comment)
      <div>
        <div>{{ $comment->created_at->diffForHumans() }}</div>
        <div>{{ $comment->name }} says...</div>
        <div>{{ $comment->body }}</div>
      </div>
      {{-- @auth --}}
        <form action="{{ route('comment.delete', $comment)  }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="border rounded-[5px] p-1">Delete</button>   
        </form> 
      {{-- @endauth --}}
    @empty
      <div>No comments yet.</div>
    @endforelse
      </div>

    
    </div>
  </div>
@endsection
