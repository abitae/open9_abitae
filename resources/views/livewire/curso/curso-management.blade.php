<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Gestión de Cursos</h2>
        <flux:button wire:click="redirectToForm()" color="primary">
            Crear Curso
        </flux:button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">
                        {{ session('message') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800 dark:text-red-200">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <flux:label for="search" class="text-gray-700 dark:text-gray-300">Buscar por nombre</flux:label>
            <flux:input type="text" wire:model.live="search" id="search" placeholder="Ingrese el nombre del curso..." class="w-full" />
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
                        Nombre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Categoría
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Nivel
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($cursos as $curso)
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $curso->name }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Str::limit($curso->description, 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $curso->category->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $curso->status === 'published'
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100'
                                    : ($curso->status === 'draft'
                                        ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100'
                                        : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200') }}">
                                {{ ucfirst($curso->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                                {{ $curso->level }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                @if ($curso->status !== 'published')
                                    <flux:button icon="check" wire:click="publish({{ $curso->id }})" color="success" size="sm">
                                    </flux:button>
                                @else
                                    <flux:button icon="x-mark" wire:click="publish({{ $curso->id }})" color="danger" size="sm">
                                    </flux:button>
                                @endif
                                <flux:button icon="pencil" wire:click="redirectToForm({{ $curso->id }})" variant="outline" size="sm">
                                </flux:button>

                                <flux:button icon="trash" wire:click="delete({{ $curso->id }})" color="danger" size="sm">
                                </flux:button>

                                <flux:button icon="academic-cap" wire:click="showLessons({{ $curso->id }})" color="info" size="sm">
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $cursos->links() }}
    </div>
</div>

<!-- Modal de Lecciones -->
@if($showLessonsModal)
    <flux:modal wire:model="showLessonsModal" max-width="2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Lecciones de {{ $selectedCurso->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $selectedCurso->lessons->count() }} lecciones</p>
                </div>
                <flux:button icon="x-mark" wire:click="closeLessonsModal" variant="ghost" size="sm">
                </flux:button>
            </div>

            <div class="space-y-4 max-h-[50vh] overflow-y-auto mb-4">
                @forelse($selectedCurso->lessons as $lesson)
                    <div class="bg-gray-50 dark:bg-neutral-700 p-4 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $lesson->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $lesson->duration }} minutos</p>
                            </div>
                            <div class="flex space-x-2">
                                <flux:button icon="pencil" wire:click="editLesson({{ $lesson->id }})" variant="outline" size="sm">
                                </flux:button>
                                <flux:button icon="trash" wire:click="deleteLesson({{ $lesson->id }})" color="danger" size="sm">
                                </flux:button>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $lesson->description }}</p>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No hay lecciones</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Agrega la primera lección a este curso.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                <div class="flex space-x-2">
                    <flux:input
                        wire:model="newLessonTitle"
                        placeholder="Título de la lección..."
                        class="flex-1"
                    />
                    <flux:input
                        wire:model="newLessonDuration"
                        type="number"
                        placeholder="Duración (min)"
                        class="w-24"
                    />
                    <flux:button
                        wire:click="addLesson"
                        color="primary"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Agregar</span>
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
