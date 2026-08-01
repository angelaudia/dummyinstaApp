<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto px-4">

            {{-- Profile Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex items-start gap-5">

                    @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}"
                            class="w-20 h-20 rounded-full object-cover flex-shrink-0" alt="{{ $user->name }}">
                    @else
                        <div
                            class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-2xl flex-shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="flex-1">
                        <h1 class="text-xl font-bold text-gray-800">{{ $user->name }}</h1>
                        <p class="text-xs text-gray-400 mt-0.5">Joined {{ $user->created_at->format('M Y') }}</p>

                        <div class="flex gap-6 mt-3">
                            <div class="text-center">
                                <p class="font-bold text-gray-800">{{ $posts->count() }}</p>
                                <p class="text-xs text-gray-400">Posts</p>
                            </div>
                            <div class="text-center">
                                <p class="font-bold text-gray-800">{{ $user->followers()->count() }}</p>
                                <p class="text-xs text-gray-400">Followers</p>
                            </div>
                            <div class="text-center">
                                <p class="font-bold text-gray-800">{{ $user->followings()->count() }}</p>
                                <p class="text-xs text-gray-400">Following</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        @auth
                            @if (auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}"
                                    class="text-sm border border-gray-200 text-gray-600 hover:bg-gray-50 px-4 py-1.5 rounded-xl transition">
                                    Edit Profile
                                </a>
                            @else
                                <form action="{{ route('users.follow', $user) }}" method="POST">
                                    @csrf
                                    <button
                                        class="text-sm px-4 py-1.5 rounded-xl text-white transition font-medium
                                    {{ auth()->user()->isFollowing($user) ? 'bg-gray-400 hover:bg-gray-500' : 'bg-indigo-600 hover:bg-indigo-700' }}">
                                        {{ auth()->user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>

                @if ($user->about)
                    <div class="mt-4 pt-4 border-t border-gray-50">
                        <p class="text-sm text-gray-600">{{ $user->about }}</p>
                    </div>
                @endif
            </div>

            {{-- Posts --}}
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Posts</h2>
            <div class="flex justify-end mb-4">
                <button onclick="document.getElementById('modal-post').classList.remove('hidden')"
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-xl transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New Post
                </button>
            </div>

            @forelse($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <div class="text-center py-16 text-gray-400">
                    <p class="text-lg mb-1">No posts yet</p>
                    @if (auth()->id() === $user->id)
                        <p class="text-sm">Share your first memory!</p>
                    @endif
                </div>
            @endforelse
            <x-modal-post />
            @if ($errors->any())
                <script>
                    document.getElementById('modal-post').classList.remove('hidden');
                </script>
            @endif

        </div>
    </div>
</x-app-layout>
