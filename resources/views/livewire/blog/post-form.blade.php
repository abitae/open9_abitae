<div>
    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <flux:label for="title">Title</flux:label>
            <flux:input type="text" wire:model="title" id="title" />
            @error('title')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label for="category_id">Category</flux:label>
            <flux:select wire:model="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </flux:select>
            @error('category_id')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label for="content">Content</flux:label>
            <flux:textarea wire:model="content" id="content" rows="10"></flux:textarea>
            @error('content')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label for="excerpt">Excerpt</flux:label>
            <flux:textarea wire:model="excerpt" id="excerpt" rows="3"></flux:textarea>
            @error('excerpt')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label for="status">Status</flux:label>
            <flux:select wire:model="status" id="status">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </flux:select>
            @error('status')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label>Tags</flux:label>
            <div class="mt-2 space-y-2">
                @foreach ($tags as $tag)
                    <label class="inline-flex items-center">
                        <flux:checkbox wire:model="selectedTags" value="{{ $tag->id }}" />
                        <span class="ml-2">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <flux:label for="images">Images</flux:label>
            <flux:input type="file" wire:model="images" id="images" multiple accept="image/*" />
            @error('images.*')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div>
            <flux:label for="videos">Videos</flux:label>
            <flux:input type="file" wire:model="videos" id="videos" multiple accept="video/*" />
            @error('videos.*')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        @if ($isEditing)
            @if ($post->images->count() > 0)
                <div>
                    <flux:label>Current Images</flux:label>
                    <div class="mt-2 grid grid-cols-4 gap-4">
                        @foreach ($post->images as $image)
                            <div class="relative">
                                <img src="{{ Storage::url($image->file_path) }}" alt="{{ $image->file_name }}"
                                    class="w-full h-32 object-cover rounded">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($post->videos->count() > 0)
                <div>
                    <flux:label>Current Videos</flux:label>
                    <div class="mt-2 grid grid-cols-4 gap-4">
                        @foreach ($post->videos as $video)
                            <div class="relative">
                                <video src="{{ Storage::url($video->file_path) }}"
                                    class="w-full h-32 object-cover rounded" controls>
                                </video>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <div class="flex justify-end space-x-3">
            <flux:button type="button" wire:click="$dispatch('close-modal')" variant="outline">
                Cancel
            </flux:button>
            <flux:button type="submit" color="primary">
                {{ $isEditing ? 'Update' : 'Create' }}
            </flux:button>
        </div>
    </form>
</div>
