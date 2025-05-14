<div class="bg-white dark:bg-neutral-800 rounded-lg p-6">
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:label for="title" class="text-gray-700 dark:text-gray-300">Title</flux:label>
                <flux:input type="text" wire:model="title" id="title" class="w-full" />
                <flux:error name="title"></flux:error>
            </div>

            <div>
                <flux:label for="category_id" class="text-gray-700 dark:text-gray-300">Category</flux:label>
                <flux:select wire:model="category_id" id="category_id" class="w-full">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="category_id"></flux:error>
            </div>
        </div>

        <div class="space-y-4">
            <flux:label class="text-gray-700 dark:text-gray-300">Content</flux:label>

            <x-mary-markdown wire:model="content" label="content" disk="public" folder="media/posts/images" />
            <flux:error name="content"></flux:error>
        </div>

        <div>
            <flux:label for="excerpt" class="text-gray-700 dark:text-gray-300">Excerpt</flux:label>
            <flux:textarea wire:model="excerpt" id="excerpt" rows="3" class="w-full"></flux:textarea>
            <flux:error name="excerpt"></flux:error>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:label for="status" class="text-gray-700 dark:text-gray-300">Status</flux:label>
                <flux:select wire:model="status" id="status" class="w-full">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </flux:select>
                <flux:error name="status"></flux:error>
            </div>

            <div>
                <flux:label class="text-gray-700 dark:text-gray-300">Tags</flux:label>
                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($tags as $tag)
                        <label
                            class="inline-flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors duration-150">
                            <flux:checkbox wire:model="selectedTags" value="{{ $tag->id }}" />
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:label for="image" class="text-gray-700 dark:text-gray-300">Imagen</flux:label>
                <div class="mt-2">
                    <div class="flex items-center justify-center w-full">
                        <label for="image_path" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-neutral-700 dark:bg-neutral-800 hover:bg-gray-100 dark:border-neutral-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF o WEBP (MAX. 10MB)</p>
                            </div>
                            <flux:input type="file" wire:model="image_path" id="image_path" accept="image/*" class="hidden" />
                        </label>
                    </div>
                    @if ($image_path)
                        <div class="mt-4">
                            <img src="{{ $image_path->temporaryUrl() }}" class="w-full h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <flux:error name="image_path"></flux:error>
                </div>
            </div>

            <div>
                <flux:label for="video" class="text-gray-700 dark:text-gray-300">Video</flux:label>
                <div class="mt-2">
                    <div class="flex items-center justify-center w-full">
                        <label for="video_path" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-neutral-700 dark:bg-neutral-800 hover:bg-gray-100 dark:border-neutral-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">MP4, MOV, AVI o WEBM (MAX. 500MB)</p>
                            </div>
                            <flux:input type="file" wire:model="video_path" id="video_path" accept="video/*" class="hidden" />
                        </label>
                    </div>
                    @if ($video_path)
                        <div class="mt-4">
                            <video src="{{ $video_path->temporaryUrl() }}" class="w-full h-32 object-cover rounded-lg" controls></video>
                        </div>
                    @endif
                    <flux:error name="video_path"></flux:error>
                </div>
            </div>
        </div>

        @if ($isEditing)
            <div class="space-y-6">
                @if ($post->image_path)
                    <div>
                        <flux:label class="text-gray-700 dark:text-gray-300">Current Images</flux:label>
                        <div class="mt-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            <div class="relative group">
                                <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->image_path }}"
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                                <button type="button" wire:click="deleteImage({{ $post->id }})"
                                    class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($post->video_path)
                    <div>
                        <flux:label class="text-gray-700 dark:text-gray-300">Videos actuales</flux:label>
                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative group">
                                <video src="{{ Storage::url($post->video_path) }}"
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700"
                                    autoplay controls>
                                    Tu navegador no admite el elemento <code>video</code>.
                                </video>
                                <button type="button" wire:click="deleteVideo({{ $post->id }})"
                                    class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <flux:button type="button" wire:click="$dispatch('close-modal')" variant="outline"
                class="w-full sm:w-auto">
                Cancel
            </flux:button>
            <flux:button type="submit" color="primary" class="w-full sm:w-auto">
                {{ $isEditing ? 'Update' : 'Create' }}
            </flux:button>
        </div>
    </form>
</div>
