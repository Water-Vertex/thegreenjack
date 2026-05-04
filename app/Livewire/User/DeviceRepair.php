<?php

namespace App\Livewire\User;

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.user-layout')]
class DeviceRepair extends Component
{
    public $slug;
    public $pages;
    public $page;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        $this->loadData();
    }

    public function loadData()
    {
        // Load all policies
        $this->pages = Page::orderBy('id', 'asc')->get();

        // Find the current policy
        if ($this->slug) {
            $this->page = Page::where('slug', $this->slug)->first();

            // If no policy is found, redirect to homepage
            if (!$this->page) {
                return redirect()->route('index')->with('error', 'Page not found');
            }
        } else {
            // If no slug provided, redirect to homepage
            return redirect()->route('index')->with('error', 'Page not specified');
        }

        // Load other policies (excluding current)
        $this->pages = Page::where('slug', '!=', $this->slug)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function refreshData()
    {
        $this->loadData();
        $this->dispatch('data-refreshed');
    }
    public function render()
    {
        $pages = Page::where('slug', $this->page->slug)->first();
        return view('livewire.user.device-repair');
    }
}
