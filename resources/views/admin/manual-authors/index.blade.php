<x-admin-layout title="Manual Authors">
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Manual Authors</h1>
                <p class="text-sm text-slate-500 mt-0.5">Manage public author profiles displayed on articles.</p>
            </div>
            <button type="button" onclick="openModal('createAuthorModal')"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Author
            </button>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Search --}}
        <form method="GET" action="{{ route('manual-authors.index') }}" class="flex gap-2">
            <div class="relative flex-1 max-w-sm">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="search" name="search" value="{{ request('search') }}"
                       placeholder="Search authors..."
                       class="w-full rounded-lg border border-slate-300 bg-white pl-10 pr-4 py-2 text-sm text-slate-900 focus:border-brand-500 focus:outline-none">
            </div>
            <button type="submit" class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium transition-colors">Search</button>
            @if(request('search'))
                <a href="{{ route('manual-authors.index') }}" class="px-4 py-2 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm transition-colors">Clear</a>
            @endif
        </form>

        {{-- Table --}}
        <section class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr class="text-left text-slate-500 font-medium">
                            <th class="px-5 py-3">Author</th>
                            <th class="px-5 py-3">Position</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Articles</th>
                            <th class="px-5 py-3">Added</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($authors as $author)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    @if($author->display_image)
                                        <img src="{{ $author->display_image }}" alt="{{ $author->name }}"
                                             class="w-9 h-9 rounded-full object-cover border border-slate-200 shrink-0">
                                    @else
                                        <div class="w-9 h-9 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center text-sm font-bold uppercase shrink-0">
                                            {{ substr($author->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-slate-900">{{ $author->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $author->position ?: '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $author->status == 1 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $author->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $author->articles_count ?? $author->articles()->count() }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $author->created_at->format('M d, Y') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-4">
                                    <button type="button"
                                            class="text-blue-600 hover:text-blue-700 transition-colors edit-author-btn -mt-3"
                                            data-id="{{ $author->id }}"
                                            data-name="{{ $author->name }}"
                                            data-position="{{ $author->position }}"
                                            data-description="{{ $author->description }}"
                                            data-status="{{ $author->status }}"
                                            data-image-url="{{ $author->image_url }}"
                                            data-image="{{ $author->display_image }}"
                                            title="Edit">
                                        <i class="fas fa-edit text-base"></i>
                                    </button>
                                    <form action="{{ route('manual-authors.destroy', $author) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('Delete this author? Articles using them will lose the manual author link.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-700 transition-colors" title="Delete">
                                            <i class="fas fa-trash text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-400">
                                No manual authors found.
                                <button type="button" onclick="openModal('createAuthorModal')" class="text-brand-500 hover:underline ml-1">Create one</button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($authors->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $authors->links('vendor.pagination.custom') }}
                </div>
            @endif
        </section>

    </div>

    {{-- Create Author Modal --}}
    <x-ui.modal id="createAuthorModal" title="New Manual Author">
        <form action="{{ route('manual-authors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            {{-- Avatar + Upload --}}
            <div class="flex items-center gap-4 py-2 bg-white">
                <div id="create_avatar_preview"
                     class="w-16 h-16 rounded-full bg-slate-200 border-2 border-slate-300 flex items-center justify-center overflow-hidden shrink-0">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1 space-y-2">
                    <label for="create_image"
                           class="inline-flex items-center gap-1.5 cursor-pointer px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-xs text-slate-700 font-semibold transition-colors">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Upload Photo
                    </label>
                    <input type="file" name="image" id="create_image" accept="image/*" class="hidden">
                    <input type="url" name="image_url" placeholder="Or paste image URL..."
                           class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none text-sm">
                </div>
            </div>

            {{-- Name --}}
            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Name <span class="text-rose-500">*</span></span>
                <input type="text" name="name" required placeholder="Full name"
                       class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none">
            </label>

            {{-- Position + Status side by side --}}
            <div class="grid grid-cols-2 gap-4">
                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Position</span>
                    <input type="text" name="position" placeholder="e.g. Reporter"
                           class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none">
                </label>
                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Status</span>
                    <select name="status" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </label>
            </div>

            {{-- Bio --}}
            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Bio</span>
                <textarea name="description" rows="3" placeholder="Short author biography..."
                          class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"></textarea>
            </label>

            {{-- Footer --}}
            <div class="flex justify-end gap-2 border-t pt-3">
                <button type="button" class="close-modal-btn px-4 py-2 border rounded-lg hover:bg-slate-50 text-slate-700 font-semibold" data-modal="createAuthorModal">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-500 text-white rounded-lg font-semibold">
                    Create Author
                </button>
            </div>
        </form>
    </x-ui.modal>

    {{-- Edit Author Modal --}}
    <x-ui.modal id="editAuthorModal" title="Edit Manual Author">
        <form id="editAuthorForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            {{-- Avatar + Upload --}}
            <div class="flex items-center gap-4 py-2 bg-white">
                <div id="edit_avatar_preview"
                     class="w-16 h-16 rounded-full bg-slate-200 border-2 border-slate-300 flex items-center justify-center overflow-hidden shrink-0">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1 space-y-2">
                    <label for="edit_image"
                           class="inline-flex items-center gap-1.5 cursor-pointer px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-xs text-slate-700 font-semibold transition-colors">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Upload Photo
                    </label>
                    <input type="file" name="image" id="edit_image" accept="image/*" class="hidden">
                    <input type="url" name="image_url" id="edit_image_url" placeholder="Or paste image URL..."
                           class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none text-sm">
                </div>
            </div>

            {{-- Name --}}
            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Name <span class="text-rose-500">*</span></span>
                <input type="text" name="name" id="edit_name" required placeholder="Full name"
                       class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none">
            </label>

            {{-- Position + Status side by side --}}
            <div class="grid grid-cols-2 gap-4">
                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Position</span>
                    <input type="text" name="position" id="edit_position" placeholder="e.g. Reporter"
                           class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none">
                </label>
                <label class="block space-y-2">
                    <span class="text-sm font-medium text-slate-700">Status</span>
                    <select name="status" id="edit_status" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </label>
            </div>

            {{-- Bio --}}
            <label class="block space-y-2">
                <span class="text-sm font-medium text-slate-700">Bio</span>
                <textarea name="description" id="edit_description" rows="3" placeholder="Short author biography..."
                          class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"></textarea>
            </label>

            {{-- Footer --}}
            <div class="flex justify-end gap-2 border-t pt-3">
                <button type="button" class="close-modal-btn px-4 py-2 border rounded-lg hover:bg-slate-50 text-slate-700 font-semibold" data-modal="editAuthorModal">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-500 text-white rounded-lg font-semibold">
                    Save Changes
                </button>
            </div>
        </form>
    </x-ui.modal>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Live preview for Create image
        const createImgInput = document.getElementById('create_image');
        if (createImgInput) {
            createImgInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('create_avatar_preview').innerHTML =
                        `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(file);
            });
        }

        // Live preview for Edit image
        const editImgInput = document.getElementById('edit_image');
        if (editImgInput) {
            editImgInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('edit_avatar_preview').innerHTML =
                        `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(file);
            });
        }

        // Edit buttons trigger
        const editForm = document.getElementById('editAuthorForm');
        document.querySelectorAll('.edit-author-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const position = this.getAttribute('data-position') || '';
                const description = this.getAttribute('data-description') || '';
                const status = this.getAttribute('data-status');
                const imageUrl = this.getAttribute('data-image-url') || '';
                const image = this.getAttribute('data-image') || '';

                // Set form action
                editForm.action = `/admin/manual-authors/${id}`;

                // Set values
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_position').value = position;
                document.getElementById('edit_status').value = status;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_image_url').value = imageUrl;

                // Set preview
                const preview = document.getElementById('edit_avatar_preview');
                if (image) {
                    preview.innerHTML = `<img src="${image}" class="w-full h-full object-cover">`;
                } else {
                    preview.innerHTML = `
                        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>`;
                }

                // Open modal using global helper
                openModal('editAuthorModal');
            });
        });
    });
    </script>
</x-admin-layout>
