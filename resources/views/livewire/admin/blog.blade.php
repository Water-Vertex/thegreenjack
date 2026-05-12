<div>
    <!-- Header -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Blog Management</h1>
                <p class="text-gray-500 mt-1">
                    Manage your blog posts with SEO optimization
                </p>
            </div>

            <button
                wire:click="create"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    ></path>
                </svg>

                Add New Blog
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex gap-4">
            <div class="flex-1">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search blogs by title, slug..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-green-500"
                >
            </div>

            <div>
                <select
                    wire:model.live="perPage"
                    class="border border-gray-300 rounded-lg px-4 py-2"
                >
                    <option value="5">5 per page</option>
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($blogs as $blog)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">
                            #{{ $blog->id }}
                        </td>

                        <td class="px-6 py-4">
                            @if($blog->image)
                                <img
                                    src="{{ Storage::url($blog->image) }}"
                                    class="w-12 h-12 object-cover rounded"
                                    alt="Blog Image"
                                >
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        ></path>
                                    </svg>
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ \Illuminate\Support\Str::limit($blog->name, 50) }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ \Illuminate\Support\Str::limit($blog->description, 60) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $blog->slug }}
                        </td>

                        <td class="px-6 py-4">
                            <button
                                wire:click="toggleStatus({{ $blog->id }})"
                                class="px-2 py-1 text-xs rounded-full {{ $blog->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}"
                            >
                                {{ $blog->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $blog->created_at->format('M d, Y') }}
                        </td>

                        <td class="px-6 py-4 text-sm space-x-2">
                            <button
                                wire:click="edit({{ $blog->id }})"
                                class="text-blue-600 hover:text-blue-800"
                            >
                                Edit
                            </button>

                            <button
                                wire:click="delete({{ $blog->id }})"
                                wire:confirm="Are you sure?"
                                class="text-red-600 hover:text-red-800"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            No blogs found. Click "Add New Blog" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if($blogs->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" wire:key="modal">
            <div class="flex items-center justify-center min-h-screen px-4">

                <!-- Backdrop -->
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75"
                    wire:click="closeModal"
                ></div>

                <!-- Modal Content -->
                <div class="relative bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">

                    <!-- Modal Header -->
                    <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
                        <h3 class="text-lg font-semibold">
                            {{ $isEdit ? 'Edit Blog' : 'Add New Blog' }}
                        </h3>

                        <button
                            wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6">
                        <form wire:submit.prevent="save">

                            <div class="space-y-4">

                                <!-- Title -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Title *
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="name"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500"
                                    >

                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Slug *
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="slug"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50"
                                    >

                                    <p class="text-xs text-gray-500 mt-1">
                                        URL-friendly version. Auto-generated from title.
                                    </p>

                                    @error('slug')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Content *
                                    </label>

                                    <textarea
                                        wire:model="description"
                                        rows="6"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500"
                                    ></textarea>

                                    @error('description')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Featured Image
                                    </label>

                                    @if($oldImage && !$image)
                                        <div class="mb-2">
                                            <img
                                                src="{{ Storage::url($oldImage) }}"
                                                class="w-24 h-24 object-cover rounded"
                                                alt="Old Image"
                                            >
                                        </div>
                                    @endif

                                    @if($image)
                                        <div class="mb-2">
                                            <img
                                                src="{{ $image->temporaryUrl() }}"
                                                class="w-24 h-24 object-cover rounded"
                                                alt="Preview"
                                            >
                                        </div>
                                    @endif

                                    <input
                                        type="file"
                                        wire:model="image"
                                        accept="image/*"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                    >

                                    <p class="text-xs text-gray-500 mt-1">
                                        Recommended: 1200x630px, Max 2MB
                                    </p>

                                    @error('image')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- SEO Section -->
                                <div class="border-t pt-4">
                                    <h4 class="font-semibold text-gray-800 mb-3">
                                        SEO Settings
                                    </h4>

                                    <div class="space-y-3">

                                        <!-- Meta Title -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Meta Title
                                            </label>

                                            <input
                                                type="text"
                                                wire:model="meta_title"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >

                                            <div class="flex justify-between mt-1">
                                                <p class="text-xs text-gray-500">
                                                    Recommended length: 50-60 characters
                                                </p>

                                                <span class="text-xs {{ strlen($meta_title ?? '') <= 60 ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ strlen($meta_title ?? '') }}/60
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Description -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Meta Description
                                            </label>

                                            <textarea
                                                wire:model="meta_description"
                                                rows="2"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            ></textarea>

                                            <div class="flex justify-between mt-1">
                                                <p class="text-xs text-gray-500">
                                                    Recommended length: 150-160 characters
                                                </p>

                                                <span class="text-xs {{ strlen($meta_description ?? '') <= 160 ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ strlen($meta_description ?? '') }}/160
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Meta Keywords
                                            </label>

                                            <input
                                                type="text"
                                                wire:model="meta_keywords"
                                                placeholder="keyword1, keyword2, keyword3"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >

                                            <p class="text-xs text-gray-500 mt-1">
                                                Comma-separated keywords for SEO
                                            </p>
                                        </div>

                                        <!-- Meta Tags -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Meta Tags
                                            </label>

                                            <input
                                                type="text"
                                                wire:model="meta_tags"
                                                placeholder="tag1, tag2, tag3"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >
                                        </div>

                                        <!-- JSON LD -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                JSON-LD Schema
                                            </label>

                                            <textarea
                                                wire:model="page_schemas"
                                                rows="4"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 font-mono text-sm"
        placeholder='{"@@context":"https://schema.org","@@type":"BlogPosting","headline":"Your Blog Title"}'
                                            ></textarea>

                                            <p class="text-xs text-gray-500 mt-1">
                                                Valid JSON-LD structured data for rich snippets
                                            </p>
                                        </div>

                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        wire:model="is_active"
                                        id="active"
                                        class="rounded border-gray-300"
                                    >

                                    <label for="active" class="ml-2 text-sm text-gray-700">
                                        Active Blog Post
                                    </label>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="sticky bottom-0 bg-white border-t mt-6 pt-4 flex justify-end gap-3">

                                <button
                                    type="button"
                                    wire:click="closeModal"
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                >
                                    {{ $isEdit ? 'Update' : 'Create' }}
                                </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
        >
            {{ session('message') }}
        </div>
    @endif
</div>
