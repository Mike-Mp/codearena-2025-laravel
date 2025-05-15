@extends('layouts.app')

@section('content')
<div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">Blog page</h2>
      </div>
      <h3 class="mt-2">Authors</h3>
      <section id="authors" class="flex gap-5 mt-5">
        @foreach ($authors as $author)
         <a class="underline" href="{{ route('author', $author) }}">{{ $author->name }}</a> 
        @endforeach
      </section>
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @if (count($posts) > 0)
          @foreach($posts as $post)
              @if ($post->image)
                <x-blog.post :post="$post" />
              @endif
          @endforeach
        @elseif (count($posts) == 0)
          <div class="">No posts found.</div>
        @endif
      </div>
      <div class="mt-16">
        {{ $posts->links() }}
      </div>
    </div>
  </div>
@endsection
