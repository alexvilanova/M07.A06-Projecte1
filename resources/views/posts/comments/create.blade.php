@can('create', 'App\Models\Comment')
    <form method="POST" action="{{ route('posts.comments', ['post' => $post->id]) }}">
        @csrf
        <div class="">
            <label for="comment" class="block text-sm font-medium text-gray-600">Comentario</label>
            <textarea name="comment" class="mt-1 p-2 w-full border rounded-md"></textarea>
        </div>
        <div class="flex justify-center">
        <button type="submit" class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">Publicar comentario</button>
        </div>
    </form>
@endcan