<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Blog Posts</h2>
        <flux:button wire:click="redirectToForm()" color="primary">
            Create Post
        </flux:button>
    </div>

    <div class="bg-white dark:bg-neutral-800 rounded-lg shadow overflow-hidden">
        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-neutral-700">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Title</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Category
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Status
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Tags</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($posts as $post)
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $post->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $post->category->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $post->status === 'published'
                                    ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100'
                                    : ($post->status === 'draft'
                                        ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100'
                                        : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($post->tags as $tag)
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                @if ($post->status !== 'published')
                                    <flux:button icon="check" wire:click="publish({{ $post->id }})"
                                        color="success" size="sm">
                                    </flux:button>
                                @else
                                    <flux:button icon="x-mark" wire:click="publish({{ $post->id }})"
                                        color="danger" size="sm">
                                    </flux:button>
                                @endif
                                <flux:button icon="pencil" wire:click="redirectToForm({{ $post->id }})"
                                    variant="outline" size="sm">
                                </flux:button>

                                <flux:button icon="trash" wire:click="delete({{ $post->id }})" color="danger"
                                    size="sm">
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
