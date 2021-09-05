<x-layout>
    <article>
        {{ $post->title }}

        <div>
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>

</x-layout>
