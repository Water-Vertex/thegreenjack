<div>
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Brand Problems Management</h1>
        <p class="text-gray-600 mt-1">Select category, brand, and assign multiple problems</p>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
            <select wire:model.live="selectedCategory"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#5C9F01]">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('selectedCategory') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Brand *</label>
            <select wire:model.live="selectedBrand"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#5C9F01]"
                {{ !$selectedCategory ? 'disabled' : '' }}>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('selectedBrand') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    @if($selectedBrand)
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Available Problems</h2>
                <span class="text-sm text-gray-500">{{ count($selectedProblems) }} selected</span>
            </div>

            @if($problems->count() > 0)
                <form wire:submit="save">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($problems as $problem)
                            <label class="border rounded-lg p-4 cursor-pointer hover:bg-gray-50 flex items-start gap-3">
                                <input type="checkbox"
                                    wire:model="selectedProblems"
                                    value="{{ $problem->id }}"
                                    class="mt-1 rounded border-gray-300 text-[#5C9F01] focus:ring-[#5C9F01]">

                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $problem->name }}</p>

                                    @if($problem->description)
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ Str::limit($problem->description, 70) }}
                                        </p>
                                    @endif

                                    <p class="text-xs text-gray-600 mt-2">
                                        Price:
                                        @if($problem->discounted_price)
                                            <span class="line-through">${{ number_format($problem->price, 2) }}</span>
                                            <span class="font-semibold text-green-600">${{ number_format($problem->discounted_price, 2) }}</span>
                                        @elseif($problem->price)
                                            <span class="font-semibold">${{ number_format($problem->price, 2) }}</span>
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    @error('selectedProblems')
                        <span class="text-red-500 text-xs block mt-3">{{ $message }}</span>
                    @enderror

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-5 py-2 bg-[#5C9F01] text-white rounded-md text-sm font-medium hover:bg-[#4a8501]">
                            Save Selected Problems
                        </button>
                    </div>
                </form>
            @else
                <div class="text-center py-10">
                    <i class="fas fa-wrench text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No problems found for this brand.</p>
                </div>
            @endif
        </div>
    @endif

    @if (session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
</div>
