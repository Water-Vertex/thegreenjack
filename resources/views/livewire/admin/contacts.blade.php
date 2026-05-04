<div>
    <!-- Header Section -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Contact Submissions</h1>
                <p class="text-gray-600 mt-1">Manage and track all customer contact form submissions</p>
            </div>
            <div class="text-sm text-gray-500">
                Total Contacts: <span class="font-semibold text-gray-900">{{ $totalContacts }}</span>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" wire:model.live.debounce="search" 
                        placeholder="Search by name, email, phone or ID..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Per Page</label>
                <select wire:model.live="perPage" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Contacts Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('id')">
                            ID
                            @if($sortField == 'id') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('name')">
                            Customer
                            @if($sortField == 'name') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('created_at')">
                            Date
                            @if($sortField == 'created_at') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($contacts as $contact)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $contact->id }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $contact->name }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $contact->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $contact->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $contact->phone_number }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                {{ $contact->services ?? 'General Inquiry' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $contact->created_at->format('M d, Y') }}
                            <div class="text-xs text-gray-400">{{ $contact->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button wire:click="viewContact({{ $contact->id }})" 
                                    class="text-blue-600 hover:text-blue-800 transition" 
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="if(confirm('Are you sure you want to delete this contact?')) { @this.deleteContact({{ $contact->id }}) }" 
                                    class="text-red-600 hover:text-red-800 transition" 
                                    title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No contacts found</p>
                            @if($search)
                            <button wire:click="clearFilters" class="mt-3 text-sm text-[#5C9F01] hover:underline">
                                <i class="fas fa-undo-alt mr-1"></i> Clear search
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($contacts->hasPages())
        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
            {{ $contacts->links() }}
        </div>
        @endif
    </div>

    <!-- View Contact Modal -->
    @if($showViewModal && $viewingContact)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Contact Details #{{ $viewingContact->id }}</h3>
                        <button wire:click="$set('showViewModal', false)" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                    <!-- Customer Information -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Customer Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Full Name:</span>
                                <p class="text-sm font-medium text-gray-900 mt-1">{{ $viewingContact->name }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Email Address:</span>
                                <p class="text-sm text-gray-900 mt-1">
                                    <a href="mailto:{{ $viewingContact->email }}" class="text-blue-600 hover:underline">
                                        {{ $viewingContact->email }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Phone Number:</span>
                                <p class="text-sm text-gray-900 mt-1">
                                    <a href="tel:{{ $viewingContact->phone_number }}" class="text-blue-600 hover:underline">
                                        {{ $viewingContact->phone_number }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Submitted On:</span>
                                <p class="text-sm text-gray-900 mt-1">{{ $viewingContact->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Information -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Service Information</h4>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Service Required:</span>
                                <p class="text-sm text-gray-900 mt-1">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $viewingContact->services ?? 'General Inquiry' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Message -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Customer Message</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $viewingContact->message }}</p>
                        </div>
                    </div>
                    
                    <!-- Additional Info -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Additional Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Contact ID:</span>
                                <p class="text-sm text-gray-900 mt-1">#{{ $viewingContact->id }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Last Updated:</span>
                                <p class="text-sm text-gray-900 mt-1">{{ $viewingContact->updated_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button wire:click="$set('showViewModal', false)" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Close
                    </button>
                    <button onclick="if(confirm('Are you sure you want to delete this contact?')) { @this.deleteContact({{ $viewingContact->id }}) }" 
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i> Delete Contact
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Flash Messages -->
    @if(session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" 
        class="fixed bottom-4 right-4 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif
    
    @if(session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" 
        class="fixed bottom-4 right-4 z-50">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif
</div>