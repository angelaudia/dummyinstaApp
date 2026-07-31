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
                    <div class="container">
                        <h1>Semua Postingan</h1>
                        @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">{{session('success')}}</div>
                        @endif

                        <div class="flex justify-end mb-4">
                        <a class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded" href="{{ route('posts.create') }}">
                            + Tambah Postingan Baru
                        </a>
                        </div>

                            @foreach ($posts as $post)
                            <div class="bg-white shadow-md rounded p-4 mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h2 class="font-bold">
                                        <a href= "{{ route('users.show' , $post->user_id) }}" class="text-blue-600 hover:underline"> {{ $post->user->name }}</a>
                                    </h2>
                                    <small class="text-gray-500">{{ $post->created_at-> diffForHumans()}}</small>
                                </div>
                                    <p class="mb-2">{{ $post->content }}</p>

                                    @if ($post->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $post->image_path) }}" class="w-1/2 h-auto rounded" alt="">
                                    </div>

                                    @endif

                                @if (auth()->check() && auth()->id() === $post->user->id)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <BUTTOn class="bg-red-600 text-white font-semibold py-1 px-3 rounded" type="submit">Hapus postingan</BUTTOn>
                                </form>
                                @endif
                            </div>

                            @endforeach
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
