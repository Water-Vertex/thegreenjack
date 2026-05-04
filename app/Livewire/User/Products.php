<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

#[Layout('components.shop-layout')]
class Products extends Component
{
    use WithPagination;

    // View settings
    public $viewType = 'grid'; // grid or list
    public $perPage = 12;
    public $sortBy = 'latest'; // latest, price_low, price_high, popular

    // Filters
    public $selectedCategories = [];
    public $selectedBrands = [];
    public $minPrice = 0;
    public $maxPrice = 10000;
    public $priceRange = [0, 10000];
    public $search = '';

    // Price range from database
    public $globalMinPrice = 0;
    public $globalMaxPrice = 10000;

    // Track which product is being added to cart
    public $addingToCart = null;

    protected $queryString = [
        'viewType' => ['except' => 'grid'],
        'sortBy' => ['except' => 'latest'],
        'perPage' => ['except' => 12],
        'selectedCategories' => ['except' => []],
        'selectedBrands' => ['except' => []],
        'priceRange' => ['except' => [0, 10000]],
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        // Get global price range for slider
        $this->globalMinPrice = Product::min('price') ?? 0;
        $this->globalMaxPrice = Product::max('price') ?? 10000;
        $this->minPrice = $this->globalMinPrice;
        $this->maxPrice = $this->globalMaxPrice;
        $this->priceRange = [$this->globalMinPrice, $this->globalMaxPrice];
    }

    public function updatedPriceRange($value)
    {
        $this->minPrice = $value[0];
        $this->maxPrice = $value[1];
        $this->resetPage();
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSelectedBrands()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function toggleView($view)
    {
        $this->viewType = $view;
    }

    public function clearFilters()
    {
        $this->selectedCategories = [];
        $this->selectedBrands = [];
        $this->priceRange = [$this->globalMinPrice, $this->globalMaxPrice];
        $this->minPrice = $this->globalMinPrice;
        $this->maxPrice = $this->globalMaxPrice;
        $this->search = '';
        $this->sortBy = 'latest';
        $this->resetPage();
        session()->flash('success', 'All filters cleared.');
    }

    public function addToCart($productId, $quantity = 1)
    {
        // Set loading state for this product
        $this->addingToCart = $productId;

        $product = Product::find($productId);

        if (!$product || $product->stock < $quantity) {
            session()->flash('error', 'Product not available in requested quantity.');
            $this->addingToCart = null;
            return;
        }

        $cart = Session::get('cart', []);
        $price = $product->discounted_price > 0 ? $product->discounted_price : $product->price;

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($newQuantity > $product->stock) {
                session()->flash('error', 'Cannot add more than available stock.');
                $this->addingToCart = null;
                return;
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'price' => $price,
                'quantity' => $quantity,
                'stock' => $product->stock
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');

        // Clear loading state
        $this->addingToCart = null;
    }

    public function getProductsProperty()
    {
        $query = Product::with('category')
            ->where('is_active', true);

        // Search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('sku', 'like', '%' . $this->search . '%');
            });
        }

        // Category filter
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Brand filter (if you have brand_id in products table)
        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand_id', $this->selectedBrands);
        }

        // Price range filter
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);

        // Sorting
        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate($this->perPage);
    }

    public function render()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('livewire.user.products', [
            'products' => $this->products,
            'categories' => $categories,
        ]);
    }
}
