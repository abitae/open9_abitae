<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Blog Posts</h2>
        <flux:button wire:click="redirectToForm()" color="primary">
            Create Post
        </flux:button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <flux:label for="search" class="text-gray-700 dark:text-gray-300">Buscar por título</flux:label>
            <flux:input type="text" wire:model.live="search" id="search" placeholder="Ingrese el título..." class="w-full" />
        </div>

        <div>
            <flux:label for="category_id" class="text-gray-700 dark:text-gray-300">Categoría</flux:label>
            <flux:select wire:model.live="category_id" id="category_id" class="w-full">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </flux:select>
        </div>

        <div>
            <flux:label for="status" class="text-gray-700 dark:text-gray-300">Estado</flux:label>
            <flux:select wire:model.live="status" id="status" class="w-full">
                <option value="">Todos los estados</option>
                <option value="draft">Borrador</option>
                <option value="published">Publicado</option>
                <option value="archived">Archivado</option>
            </flux:select>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-800 rounded-lg shadow overflow-hidden">
        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-neutral-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Título
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Categoría
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Etiquetas
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($posts as $post)
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $post->title }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Str::limit($post->excerpt, 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $post->category->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $post->status === 'published'
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100'
                                    : ($post->status === 'draft'
                                        ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100'
                                        : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($post->tags as $tag)
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                @if ($post->status !== 'published')
                                    <flux:button icon="check" wire:click="publish({{ $post->id }})" color="success" size="sm">
                                    </flux:button>
                                @else
                                    <flux:button icon="x-mark" wire:click="publish({{ $post->id }})" color="danger" size="sm">
                                    </flux:button>
                                @endif
                                <flux:button icon="pencil" wire:click="redirectToForm({{ $post->id }})" variant="outline" size="sm">
                                </flux:button>

                                <flux:button icon="trash" wire:click="delete({{ $post->id }})" color="danger" size="sm">
                                </flux:button>

                                <flux:button icon="chat-bubble-left" wire:click="showComments({{ $post->id }})" color="info" size="sm">
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

<!-- Modal de Comentarios -->
@if($showCommentsModal)
    <flux:modal wire:model="showCommentsModal" max-width="2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Comentarios de {{ $selectedPost->title }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $selectedPost->comments->count() }} comentarios</p>
                </div>
                <flux:button icon="x-mark" wire:click="closeCommentsModal" variant="ghost" size="sm">
                </flux:button>
            </div>

            @if(session()->has('message'))
                <flux:alert type="success" class="mb-4">
                    {{ session('message') }}
                </flux:alert>
            @endif

            @if(session()->has('error'))
                <flux:alert type="danger" class="mb-4">
                    {{ session('error') }}
                </flux:alert>
            @endif

            <div class="space-y-4 max-h-[50vh] overflow-y-auto mb-4" wire:poll.5s>
                @forelse($selectedPost->comments as $comment)
                    <div class="bg-gray-50 dark:bg-neutral-700 p-4 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-neutral-600 flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <flux:button wire:click="replyTo({{ $comment->id }})" variant="link" size="sm">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    Responder
                                </span>
                            </flux:button>
                        </div>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>

                        @if($comment->replies->count() > 0)
                            <div class="mt-4 ml-4 space-y-4">
                                @foreach($comment->replies as $reply)
                                    <div class="bg-gray-100 dark:bg-neutral-600 p-3 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-neutral-500 flex items-center justify-center">
                                                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                                    {{ substr($reply->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $reply->user->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $reply->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No hay comentarios</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Sé el primero en comentar.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                @if($replyToComment)
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Respondiendo a un comentario</span>
                        <flux:button wire:click="cancelReply" variant="link" color="danger" size="sm">
                            Cancelar
                        </flux:button>
                    </div>
                @endif
                <div class="flex space-x-2">
                    <flux:input
                        wire:model="newComment"
                        placeholder="Escribe tu comentario..."
                        class="flex-1"
                        wire:keydown.enter="addComment"
                        x-ref="commentInput"
                        x-on:focus="$wire.emit('focusCommentInput')"
                    />
                    <flux:button
                        wire:click="addComment"
                        color="primary"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Enviar</span>
                        <span wire:loading>
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
@endif
