<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1>All Posts</h1>
                        {{-- @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">{{session('success')}}</div>
                        @endif --}}

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
                        
                        @forelse ($posts as $post)
                            <x-post-card :post="$post" />
                        @empty
                            <p class="text-gray-400 text-center py-10">No posts yet.</p>
                        @endforelse
                        <x-modal-post />
                         @if ($errors->any())
                            <script>
                                document.getElementById('modal-post').classList.remove('hidden');
                            </script>
                        @endif

                    </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
