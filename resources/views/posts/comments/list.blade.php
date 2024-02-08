@if($comments->isNotEmpty())
    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="border-b border-gray-200 pb-4">
                <p class="text-sm font-semibold text-gray-800">{{ $comment->author->name }}</p>
                <p class="text-gray-600">{{ $comment->comment }}</p>
                <p class="text-sm text-gray-600">{{ $comment->created_at->format('d M Y H:i') }}</p>

                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            {{ __('Delete') }}
                        </button>
                    </form>
                @endcan
            </div>
        @endforeach
    </div>
@else
    <p class="text-sm text-gray-500">{{ __('No comments yet.') }}</p>
@endif
