<div id="modal-post" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-semibold text-gray-800">Create New Post</h2>
            <button onclick="document.getElementById('modal-post').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-6 py-4 space-y-4">

                <div>
                    <textarea name="content" rows="3" placeholder="Write a caption..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-300 resize-none">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Photo <span
                            class="text-red-400">*</span></label>
                    <label
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-indigo-300 hover:bg-indigo-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs text-gray-400" id="file-label">Click to upload photo</span>
                        <input type="file" name="image" accept="image/*" class="hidden"
                            onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Click to upload photo'">
                    </label>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex gap-2 justify-end px-6 py-4 border-t border-gray-100">
                <button type="button" onclick="document.getElementById('modal-post').classList.add('hidden')"
                    class="text-sm px-5 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl transition font-medium">
                    Post
                </button>
            </div>
        </form>
    </div>
</div>
