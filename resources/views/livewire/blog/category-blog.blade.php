<div>
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Categorías del Blog</h1>
            <flux:button wire:click="openModal('create')" color="primary">
                Crear Categoría
            </flux:button>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow overflow-hidden">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Color</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ Str::limit($category->description, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: {{ $category->color }}"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                    {{ $category->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                <flux:button icon="pencil" wire:click="openModal('edit', {{ $category->id }})" color="primary" size="sm">
                                </flux:button>
                                <flux:button icon="trash" wire:click="delete({{ $category->id }})" color="danger" size="sm">
                                </flux:button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <flux:modal wire:model="showModal" :title="$modalTitle">
        <form wire:submit.prevent="save">
            <div class="mb-4">
                <flux:label for="name">Nombre</flux:label>
                <flux:input wire:model="name" id="name" type="text" />
                @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <flux:label for="description">Descripción</flux:label>
                <flux:textarea wire:model="description" id="description"></flux:textarea>
                @error('description') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <flux:label for="image">Imagen</flux:label>
                <flux:input wire:model="image" id="image" type="file" />
                @error('image') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <flux:label for="color">Color</flux:label>
                <flux:input wire:model="color" id="color" type="color" />
                @error('color') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <flux:checkbox wire:model="is_active" label="Activo" />
            </div>

            <div class="flex justify-end space-x-3">
                <flux:button wire:click="closeModal" variant="outline">
                    Cancelar
                </flux:button>
                <flux:button type="submit" color="primary">
                    Guardar
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
