<div>
    @if ($posts->count())
        <div class="mx-5 grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}"
                            alt=" Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div>
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center text-sm font-bold text-gray-600">No hay Posts, para ver publicaciones en tu muro has de
            seguir
            a alguien</p>
    @endif
</div>

