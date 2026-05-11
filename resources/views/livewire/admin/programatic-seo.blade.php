<div class="p-6">
    {{-- Header --}}
    <div class="bg-white rounded-lg border p-6 mb-6 flex justify-between items-center shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Programatic SEO Management</h1>
            <p class="text-gray-600 text-sm">Upload CSV/Excel to manage SEO records</p>
        </div>
        <span class="bg-blue-50 text-blue-700 px-4 py-1 rounded-full text-sm font-bold border border-blue-100">Total: {{ $totalCount }}</span>
    </div>

    {{-- IMPORT CARD (No Alpine, pure Livewire loading) --}}
    <div class="bg-white rounded-lg border border-gray-200 mb-6 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-file-import mr-2 text-blue-500"></i>Import CSV / Excel File
            </h3>
            <div wire:loading wire:target="csvFile" class="text-blue-600 text-xs font-bold animate-pulse">
                <i class="fas fa-spinner fa-spin mr-1"></i> Uploading file...
            </div>
        </div>
        <div class="p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <div class="flex-1 w-full">
                    <input type="file" 
                           wire:model="csvFile" 
                           wire:key="file-input-{{ $fileInputKey }}" 
                           accept=".csv,.xls,.xlsx,.txt"
                           class="w-full text-sm text-gray-500 border border-gray-300 rounded-md bg-gray-50 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('csvFile') 
                        <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <button wire:click="importFile" 
                        wire:loading.attr="disabled"
                        wire:target="importFile"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md flex items-center font-bold shadow-md transition-all hover:bg-blue-700 disabled:opacity-50 min-w-[160px] justify-center">
                    <span wire:loading.remove wire:target="importFile">
                        <i class="fas fa-upload mr-2"></i>Import Now
                    </span>
                    <span wire:loading wire:target="importFile" class="flex items-center">
                        <svg class="animate-spin h-4 w-4 mr-2" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Processing...
                    </span>
                </button>
            </div>

            @if($importMessage)
                <div class="mt-4 p-4 rounded-md {{ $importSuccess ? 'bg-green-50 text-green-800 border-green-200' : 'bg-red-50 text-red-800 border-red-200' }} border">
                    <div class="flex items-center gap-2">
                        <i class="fas {{ $importSuccess ? 'fa-check-circle text-green-500' : 'fa-exclamation-circle text-red-500' }}"></i>
                        <p class="text-sm font-bold">{{ $importMessage }}</p>
                    </div>
                    @if($importSuccess && ($importSummary['new'] > 0 || $importSummary['updated'] > 0))
                        <div class="flex gap-4 mt-2 text-xs font-bold uppercase">
                            <span class="text-green-600">New: {{ $importSummary['new'] }}</span>
                            <span class="text-blue-600">Updated: {{ $importSummary['updated'] }}</span>
                            <span class="text-gray-500">Skipped: {{ $importSummary['skipped'] }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- SEARCH & PER PAGE --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Search by keyword, title, heading or ID..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Per Page</label>
                <select wire:model.live="perPage"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>
    </div>

    {{-- LOADING INDICATOR (search/pagination/import) --}}
    <div wire:loading wire:target="search,perPage,sortBy,importFile"
        class="bg-white rounded-lg border border-gray-200 p-8 text-center mb-6">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto"></div>
        <p class="text-gray-500 mt-2 text-sm">Loading...</p>
    </div>

    {{-- FULL TABLE (all columns restored) --}}
    <div wire:loading.remove wire:target="search,perPage,sortBy,importFile"
        class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th wire:click="sortBy('id')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 select-none">ID @if($sortField=='id')<i class="fas fa-sort-{{ $sortDirection=='asc' ? 'up' : 'down' }} ml-1"></i>@endif</th>
                        <th wire:click="sortBy('focus_keyword')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 select-none">Focus Keyword @if($sortField=='focus_keyword')<i class="fas fa-sort-{{ $sortDirection=='asc' ? 'up' : 'down' }} ml-1"></i>@endif</th>
                        <th wire:click="sortBy('title')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 select-none">Title @if($sortField=='title')<i class="fas fa-sort-{{ $sortDirection=='asc' ? 'up' : 'down' }} ml-1"></i>@endif</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">H1 Heading</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th wire:click="sortBy('created_at')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 select-none">Date @if($sortField=='created_at')<i class="fas fa-sort-{{ $sortDirection=='asc' ? 'up' : 'down' }} ml-1"></i>@endif</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $record->id }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-[180px]"><span class="block truncate" title="{{ $record->focus_keyword }}">{{ $record->focus_keyword }}</span></td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-[180px]"><span class="block truncate" title="{{ $record->title }}">{{ $record->title ?: '—' }}</span></td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-[200px]"><span class="block truncate" title="{{ $record->h1_heading }}">{{ $record->h1_heading ? Str::limit($record->h1_heading, 50) : '—' }}</span></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($record->image)<img src="{{ $record->image }}" alt="{{ $record->image_alt }}" class="w-10 h-10 object-cover rounded border border-gray-200" onerror="this.style.display='none'">
                            @else<span class="text-gray-400 text-xs">No image</span>@endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->created_at->format('M d, Y') }}<div class="text-xs text-gray-400">{{ $record->created_at->format('h:i A') }}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('seo.show', $record->slug ?? Str::slug($record->focus_keyword ?? '')) }}" target="_blank" class="px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200 text-xs font-medium"><i class="fas fa-eye mr-1"></i>View</a>
                                <button wire:click="openEditModal({{ $record->id }})" class="px-3 py-1 bg-orange-100 text-orange-700 rounded hover:bg-orange-200 text-xs font-medium"><i class="fas fa-edit mr-1"></i>Edit</button>
                                <button wire:click="confirmDelete({{ $record->id }})" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-medium"><i class="fas fa-trash mr-1"></i>Delete</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-12 text-center"><i class="fas fa-file-csv text-4xl text-gray-300 mb-3 block"></i><p class="text-gray-500">No SEO records found</p>@if($search)<button wire:click="$set('search','')" class="mt-2 text-sm text-green-600 hover:underline"><i class="fas fa-undo-alt mr-1"></i>Clear search</button>@endif</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($records->hasPages())<div class="border-t border-gray-200 px-6 py-4 bg-gray-50">{{ $records->links() }}</div>@endif
    </div>

    {{-- EDIT MODAL (full fields as before) --}}
    @if($showFormModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-all" wire:click="$set('showFormModal',false)"></div>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full relative z-10">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900"><i class="fas {{ $editingId ? 'fa-edit text-orange-500' : 'fa-plus-circle text-green-500' }} mr-2"></i>{{ $editingId ? 'Edit SEO Record' : 'Add New SEO Record' }}</h3>
                    <button wire:click="$set('showFormModal',false)" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-lg"></i></button>
                </div>
                <div class="px-6 py-5 max-h-[75vh] overflow-y-auto space-y-5">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-3 border-b pb-1">Basic Info</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Focus Keyword <span class="text-red-500">*</span></label><input type="text" wire:model.defer="focus_keyword" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500">@error('focus_keyword')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Title</label><input type="text" wire:model.defer="title" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500">@error('title')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Slug</label><input type="text" wire:model.defer="slug" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500">@error('slug')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">H1 Heading</label><input type="text" wire:model.defer="h1_heading" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"></div>
                        </div>
                    </div>
                    <div><h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-3 border-b pb-1">SEO Meta</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label><input type="text" wire:model.defer="meta_title" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label><input type="text" wire:model.defer="meta_keywords" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label><textarea wire:model.defer="meta_description" rows="2" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"></textarea></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Tags</label><input type="text" wire:model.defer="meta_tags" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Page Schema (JSON-LD)</label><textarea wire:model.defer="page_schema" rows="2" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm font-mono focus:ring-green-500 focus:border-green-500"></textarea></div>
                        </div>
                    </div>
                    <div><h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-3 border-b pb-1">Main Content</h4><textarea wire:model.defer="content" rows="5" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm font-mono focus:ring-green-500 focus:border-green-500"></textarea></div>
                    <div><h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-3 border-b pb-1">Main Image</h4><div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div><label>Image URL</label><input type="text" wire:model.defer="image"></div><div><label>Alt Text</label><input type="text" wire:model.defer="image_alt"></div></div></div>
                    <div><h4 class="text-sm font-semibold">Left Section</h4><div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div><label>Image Left URL</label><input type="text" wire:model.defer="image_left"></div><div><label>Image Left Alt</label><input type="text" wire:model.defer="image_left_alt"></div><div class="md:col-span-2"><label>Content Left</label><textarea wire:model.defer="section_content_left" rows="3"></textarea></div></div></div>
                    <div><h4 class="text-sm font-semibold">Right Section</h4><div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div><label>Image Right URL</label><input type="text" wire:model.defer="image_right"></div><div><label>Image Right Alt</label><input type="text" wire:model.defer="image_right_alt"></div><div class="md:col-span-2"><label>Content Right</label><textarea wire:model.defer="section_content_right" rows="3"></textarea></div></div></div>
                    <div><h4 class="text-sm font-semibold">FAQs (JSON)</h4><textarea wire:model.defer="faqs" rows="4" placeholder='[{"question":"...","answer":"..."}]' class="w-full border rounded-md font-mono text-sm"></textarea></div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button wire:click="$set('showFormModal',false)" class="px-4 py-2 text-gray-700 bg-white border rounded-md hover:bg-gray-50">Cancel</button>
                    <button wire:click="save" class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    @endif

   {{-- DELETE MODAL --}}
@if($showDeleteModal)
<div class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">

    {{-- BACKDROP --}}
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"
         wire:click="$set('showDeleteModal', false)">
    </div>

    {{-- MODAL --}}
    <div class="flex items-center justify-center min-h-screen px-4 relative z-50">

        <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full text-center relative z-50">

            <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>

            <h3 class="text-lg font-semibold mb-2">
                Delete SEO Record?
            </h3>

            <p class="text-gray-600 text-sm mb-6">
                This action cannot be undone.
            </p>

            <div class="flex justify-center gap-3">
                <button
                    wire:click="$set('showDeleteModal',false)"
                    class="px-4 py-2 text-gray-700 bg-white border rounded-md hover:bg-gray-50">
                    Cancel
                </button>

                <button
                    wire:click="deleteRecord"
                    class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Yes, Delete
                </button>
            </div>

        </div>

    </div>
</div>
@endif

    {{-- FLASH MESSAGES --}}
    @if(session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show" class="fixed bottom-4 right-4 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
    @endif
</div>