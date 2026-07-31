<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">
                        {{ $user->name }}
                    </h1>
                    <div class="mb-6">
                        <p>
                            Joined on {{ $user->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <h2 class="text-xl font-bold mb-2"> Post by {{ $user->name }}</h2>
                    @forelse($posts as $post)
                    <div class="bg-white shadow-md rounded p-4 mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-bold">
                                {{ $user->name }}
                          </h2>
                            <small class="text-gray-500">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-2">{{ $post->content }}</p>

                        @if ($post->image_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="w-1/2 h-auto rounded">
                        </div>
                        @endif
                         @if (auth()->check() && auth()->id() === $post->user->id)
                                <form action="{{ route('posts.destroy', $post) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <BUTTOn class="bg-red-600 text-white font-semibold py-1 px-3 rounded" type="submit">Hapus postingan</BUTTOn>
                                </form>
                                @endif
                            </div>
                            @empty
                            <p class="text-gray-600">Tidak ada postingan</p>
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
