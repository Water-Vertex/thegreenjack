<div>
    <!-- Header Section -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Repair Requests</h1>
                <p class="text-gray-600 mt-1">Manage and track all customer repair requests</p>
            </div>
            <div class="text-sm text-gray-500">
                Total Requests: <span class="font-semibold text-gray-900">{{ $statusCounts['total'] }}</span>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-white rounded-lg border border-gray-200 p-4 cursor-pointer hover:shadow-md transition" wire:click="$set('statusFilter', '')">
            <div class="text-sm text-gray-500">Total</div>
            <div class="text-2xl font-bold text-gray-900">{{ $statusCounts['total'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 cursor-pointer hover:shadow-md transition" wire:click="$set('statusFilter', 'pending')">
            <div class="text-sm text-gray-500">Pending</div>
            <div class="text-2xl font-bold text-yellow-600">{{ $statusCounts['pending'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 cursor-pointer hover:shadow-md transition" wire:click="$set('statusFilter', 'confirmed')">
            <div class="text-sm text-gray-500">Confirmed</div>
            <div class="text-2xl font-bold text-blue-600">{{ $statusCounts['confirmed'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 cursor-pointer hover:shadow-md transition" wire:click="$set('statusFilter', 'in_progress')">
            <div class="text-sm text-gray-500">In Progress</div>
            <div class="text-2xl font-bold text-purple-600">{{ $statusCounts['in_progress'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 cursor-pointer hover:shadow-md transition" wire:click="$set('statusFilter', 'completed')">
            <div class="text-sm text-gray-500">Completed</div>
            <div class="text-2xl font-bold text-green-600">{{ $statusCounts['completed'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 cursor-pointer hover:shadow-md transition" wire:click="$set('statusFilter', 'cancelled')">
            <div class="text-sm text-gray-500">Cancelled</div>
            <div class="text-2xl font-bold text-red-600">{{ $statusCounts['cancelled'] }}</div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" wire:model.live.debounce="search" placeholder="Search by name, email, phone or ID..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Filter</label>
                <select wire:model.live="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Per Page</label>
                <select wire:model.live="perPage" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                <input type="date" wire:model.live="dateFrom" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                <input type="date" wire:model.live="dateTo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#5C9F01] focus:border-[#5C9F01]">
            </div>
        </div>
    </div>
    
    <!-- Requests Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('id')">
                            ID
                            @if($sortField == 'id') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('first_name')">
                            Customer
                            @if($sortField == 'first_name') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Problems</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('total_price')">
                            Total
                            @if($sortField == 'total_price') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('status')">
                            Status
                            @if($sortField == 'status') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" wire:click="sortBy('created_at')">
                            Date
                            @if($sortField == 'created_at') <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $request->id }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $request->first_name }} {{ $request->last_name }}</div>
                            <div class="text-xs text-gray-500">{{ $request->email }}</div>
                            <div class="text-xs text-gray-500">{{ $request->mobile }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $request->category->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $request->brand->name ?? '-' }} - {{ $request->model->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $request->problems_list }}">
                                {{ $request->problems_list }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-green-600">${{ number_format($request->total_price, 2) }}</div>
                            <div class="text-xs text-gray-500">Tax: ${{ number_format($request->tax, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $this->getStatusBadgeClass($request->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button wire:click="viewRequest({{ $request->id }})" class="text-blue-600 hover:text-blue-800" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button wire:click="openStatusModal({{ $request->id }}, '{{ $request->status }}', '{{ $request->admin_notes }}')" class="text-green-600 hover:text-green-800" title="Update Status">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="deleteRequest({{ $request->id }})" wire:confirm="Are you sure you want to delete this request?" class="text-red-600 hover:text-red-800" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No repair requests found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($requests->hasPages())
        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
            {{ $requests->links() }}
        </div>
        @endif
    </div>
    
    <!-- View Request Modal -->
    @if($showViewModal && $viewingRequest)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Repair Request #{{ $viewingRequest->id }}</h3>
                        <button wire:click="$set('showViewModal', false)" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                    <!-- Customer Information -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Customer Information</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div><span class="text-sm text-gray-500">Name:</span> <span class="text-sm font-medium">{{ $viewingRequest->first_name }} {{ $viewingRequest->last_name }}</span></div>
                            <div><span class="text-sm text-gray-500">Email:</span> <span class="text-sm">{{ $viewingRequest->email }}</span></div>
                            <div><span class="text-sm text-gray-500">Mobile:</span> <span class="text-sm">{{ $viewingRequest->mobile }}</span></div>
                            <div><span class="text-sm text-gray-500">IMEI:</span> <span class="text-sm">{{ $viewingRequest->imei ?? 'N/A' }}</span></div>
                        </div>
                    </div>
                    
                    <!-- Device Information -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Device Information</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div><span class="text-sm text-gray-500">Category:</span> <span class="text-sm">{{ $viewingRequest->category->name ?? '-' }}</span></div>
                            <div><span class="text-sm text-gray-500">Brand:</span> <span class="text-sm">{{ $viewingRequest->brand->name ?? '-' }}</span></div>
                            <div><span class="text-sm text-gray-500">Model:</span> <span class="text-sm">{{ $viewingRequest->model->name ?? '-' }}</span></div>
                        </div>
                    </div>
                    
                    <!-- Problems -->
                    <td class="px-6 py-4">
    <div class="text-sm text-gray-600 max-w-xs truncate">
        @php
            $problemsList = $request->problems;
            if (is_string($problemsList)) {
                $problemsList = json_decode($problemsList, true);
            }
            $problemNames = is_array($problemsList) ? implode(', ', array_column($problemsList, 'name')) : '';
        @endphp
        {{ $problemNames ?: 'No problems' }}
    </div>
</td>
                    
                    <!-- Pricing -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Pricing</h4>
                        <div class="space-y-1">
                            <div class="flex justify-between"><span class="text-gray-600">Subtotal:</span> <span>${{ number_format($viewingRequest->subtotal, 2) }}</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Tax (10%):</span> <span>${{ number_format($viewingRequest->tax, 2) }}</span></div>
                            <div class="flex justify-between pt-2 border-t"><span class="font-bold">Total:</span> <span class="font-bold text-green-600">${{ number_format($viewingRequest->total_price, 2) }}</span></div>
                        </div>
                    </div>
                    
                    <!-- Service Details -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Service Details</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div><span class="text-sm text-gray-500">Service Type:</span> <span class="text-sm capitalize">{{ str_replace('_', ' ', $viewingRequest->service_type) }}</span></div>
                            <div><span class="text-sm text-gray-500">Preferred Date:</span> <span class="text-sm">{{ $viewingRequest->preferred_date ? $viewingRequest->preferred_date->format('M d, Y') : 'N/A' }}</span></div>
                            <div><span class="text-sm text-gray-500">Preferred Time:</span> <span class="text-sm">{{ $viewingRequest->preferred_time ? date('g:i A', strtotime($viewingRequest->preferred_time)) : 'N/A' }}</span></div>
                            <div><span class="text-sm text-gray-500">Status:</span> <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $this->getStatusBadgeClass($viewingRequest->status) }}">{{ ucfirst(str_replace('_', ' ', $viewingRequest->status)) }}</span></div>
                        </div>
                    </div>
                    
                    <!-- Address -->
                    @if($viewingRequest->address)
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Address</h4>
                        <p class="text-sm">{{ $viewingRequest->address }}</p>
                        <p class="text-sm">{{ $viewingRequest->city }}, {{ $viewingRequest->state }} {{ $viewingRequest->zip_code }}</p>
                        <p class="text-sm">{{ $viewingRequest->country }}</p>
                    </div>
                    @endif
                    
                    <!-- Message -->
                    @if($viewingRequest->message)
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Customer Message</h4>
                        <p class="text-sm text-gray-600">{{ $viewingRequest->message }}</p>
                    </div>
                    @endif
                    
                    <!-- Admin Notes -->
                    @if($viewingRequest->admin_notes)
                    <div>
                        <h4 class="text-md font-semibold text-gray-900 mb-3 border-b pb-2">Admin Notes</h4>
                        <p class="text-sm text-gray-600">{{ $viewingRequest->admin_notes }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                    <button wire:click="$set('showViewModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Update Status Modal -->
    @if($showStatusModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Update Request Status</h3>
                </div>
                
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select wire:model="selectedStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                        <textarea wire:model="adminNotes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#5C9F01] focus:border-[#5C9F01]" placeholder="Add notes about this request..."></textarea>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button wire:click="$set('showStatusModal', false)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
                    <button wire:click="updateStatus" class="px-4 py-2 text-sm font-medium text-white bg-[#5C9F01] rounded-md hover:bg-[#4a7e01]">Update Status</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Flash Messages -->
    @if(session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed bottom-4 right-4 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif
    
    @if(session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="fixed bottom-4 right-4 z-50">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif
</div>