<div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-5 overflow-hidden">

    <div class="flex items-center justify-between px-4 pt-4 pb-2">
        <div class="flex items-center gap-3">
            @if ($post->user->profile_image)
                <img src="{{ asset('storage/' . $post->user->profile_image) }}" class="w-9 h-9 rounded-full object-cover"
                    alt="{{ $post->user->name }}">
            @else
                <div
                    class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <a href="{{ route('users.show', $post->user_id) }}"
                    class="font-semibold text-sm text-gray-800 hover:text-indigo-600">
                    {{ $post->user->name }}
                </a>
                <p class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
            </div>

            @auth
                @if (auth()->id() !== $post->user_id)
                    <form action="{{ route('users.follow', $post->user) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-xs px-2 py-0.5 rounded-full border transition
                    {{ auth()->user()->isFollowing($post->user)
                        ? 'border-gray-300 text-gray-400 hover:border-red-300 hover:text-red-400'
                        : 'border-indigo-400 text-indigo-500 hover:bg-indigo-50' }}">
                            {{ auth()->user()->isFollowing($post->user) ? 'Unfollow' : '+ Follow' }}
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    <div class="px-4 pb-3">
        <p class="text-sm text-gray-700">{{ $post->content }}</p>
    </div>

    @if ($post->image_path)
        <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full object-contain max-h-80 bg-gray-50"
            alt="">
    @endif

    <div class="flex items-center gap-4 px-4 py-3 border-t border-gray-50">
        <form action="{{ route('posts.like', $post) }}" method="POST">
            @csrf
            @auth
                <button type="submit"
                    class="flex items-center gap-1 text-sm
                {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400 hover:text-red-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                        fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    {{ $post->likes()->count() }}
                </button>
            @endauth
        </form>
        <span class="text-sm text-gray-400">{{ $post->comments->count() }} comments</span>

        @if (auth()->check() && auth()->id() === $post->user->id)
            <div class="ml-auto flex gap-2">
                <div class="ml-auto flex gap-2">
                    @if (auth()->id() === $post->user_id)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-medium">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
    </div>

    @if ($post->comments->count() > 0)
        <div class="px-4 pb-3 space-y-2">
            @foreach ($post->comments as $comment)
                <div class="text-sm">
                    <span class="font-semibold text-gray-700">{{ $comment->user->name }}</span>
                    <span class="text-gray-500 text-xs ml-1">{{ $comment->created_at->diffForHumans() }}</span>
                    <p class="text-gray-600">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    @endif

    @auth
        <div class="px-4 pb-4 border-t border-gray-50 pt-3">
            <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="body" placeholder="Add a comment..."
                    class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-300">
                <button type="submit"
                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg transition">
                    Post
                </button>
            </form>
        </div>
    @endauth
</div>
