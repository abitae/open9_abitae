<div class="bg-white dark:bg-neutral-800 rounded-lg p-6">
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:label for="title" class="text-gray-700 dark:text-gray-300">Title</flux:label>
                <flux:input type="text" wire:model="title" id="title" class="w-full" />
                @error('title')
                    <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
                @enderror
            </div>

            <div>
                <flux:label for="category_id" class="text-gray-700 dark:text-gray-300">Category</flux:label>
                <flux:select wire:model="category_id" id="category_id" class="w-full">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </flux:select>
                @error('category_id')
                    <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
                @enderror
            </div>
        </div>

        <div class="space-y-4">
            <flux:label class="text-gray-700 dark:text-gray-300">Content</flux:label>
            
            <x-mary-markdown
                wire:model="content"
                label="content"
                disk="public"
                folder="media/posts/images"
                class="min-h-[300px]"
            />
            @error('content')
                <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label for="excerpt" class="text-gray-700 dark:text-gray-300">Excerpt</flux:label>
            <flux:textarea
                wire:model="excerpt"
                id="excerpt"
                rows="3"
                class="w-full"
            ></flux:textarea>
            @error('excerpt')
                <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:label for="status" class="text-gray-700 dark:text-gray-300">Status</flux:label>
                <flux:select wire:model="status" id="status" class="w-full">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </flux:select>
                @error('status')
                    <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
                @enderror
            </div>

            <div>
                <flux:label class="text-gray-700 dark:text-gray-300">Tags</flux:label>
                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($tags as $tag)
                        <label class="inline-flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors duration-150">
                            <flux:checkbox wire:model="selectedTags" value="{{ $tag->id }}" />
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:label for="images" class="text-gray-700 dark:text-gray-300">Images</flux:label>
                <flux:input
                    type="file"
                    wire:model="images"
                    id="images"
                    multiple
                    accept="image/*"
                    class="w-full"
                />
                @error('images.*')
                    <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
                @enderror
            </div>

            <div>
                <flux:label for="videos" class="text-gray-700 dark:text-gray-300">Videos</flux:label>
                <flux:input
                    type="file"
                    wire:model="videos"
                    id="videos"
                    multiple
                    accept="video/*"
                    class="w-full"
                />
                @error('videos.*')
                    <flux:error class="text-red-500 dark:text-red-400">{{ $message }}</flux:error>
                @enderror
            </div>
        </div>

        @if ($isEditing)
            <div class="space-y-6">
                @if ($post->images->count() > 0)
                    <div>
                        <flux:label class="text-gray-700 dark:text-gray-300">Current Images</flux:label>
                        <div class="mt-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($post->images as $image)
                                <div class="relative group">
                                    <img
                                        src="{{ Storage::url($image->file_path) }}"
                                        alt="{{ $image->file_name }}"
                                        class="w-full h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700"
                                    >
                                    <button
                                        type="button"
                                        wire:click="deleteImage({{ $image->id }})"
                                        class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-150"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($post->videos->count() > 0)
                    <div>
                        <flux:label class="text-gray-700 dark:text-gray-300">Current Videos</flux:label>
                        <div class="mt-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($post->videos as $video)
                                <div class="relative group">
                                    <video
                                        src="{{ Storage::url($video->file_path) }}"
                                        class="w-full h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700"
                                        controls
                                    >
                                    </video>
                                    <button
                                        type="button"
                                        wire:click="deleteVideo({{ $video->id }})"
                                        class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-150"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <flux:button
                type="button"
                wire:click="$dispatch('close-modal')"
                variant="outline"
                class="w-full sm:w-auto"
            >
                Cancel
            </flux:button>
            <flux:button
                type="submit"
                color="primary"
                class="w-full sm:w-auto"
            >
                {{ $isEditing ? 'Update' : 'Create' }}
            </flux:button>
        </div>
    </form>
</div>
