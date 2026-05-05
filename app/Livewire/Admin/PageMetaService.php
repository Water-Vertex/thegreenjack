<?php

namespace App\Livewire\Admin;

use App\Models\PageMeta;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.admin-layout')]
class PageMetaService extends Component
{
    public $settings;
    public $activeTab = 'home';
    public $seoScore = 0;
    public $seoMetrics = [];

    // Home Page
    public $home_meta_title = '';
    public $home_meta_description = '';
    public $home_meta_keywords = '';
    public $home_meta_tags = '';
    public $home_title = '';
    public $home_page_schema = '';

    // About Page
    public $about_meta_title = '';
    public $about_meta_description = '';
    public $about_meta_keywords = '';
    public $about_meta_tags = '';
    public $about_title = '';
    public $about_page_schema = '';

    // Contact Page
    public $contact_meta_title = '';
    public $contact_meta_description = '';
    public $contact_meta_keywords = '';
    public $contact_meta_tags = '';
    public $contact_title = '';
    public $contact_page_schema = '';

    // Service Page
    public $service_meta_title = '';
    public $service_meta_description = '';
    public $service_meta_keywords = '';
    public $service_meta_tags = '';
    public $service_title = '';
    public $service_page_schema = '';

    // Products Page
    public $products_meta_title = '';
    public $products_meta_description = '';
    public $products_meta_keywords = '';
    public $products_meta_tags = '';
    public $product_page_schema = '';

    // FAQ Page
    public $faq_meta_title = '';
    public $faq_meta_description = '';
    public $faq_meta_keywords = '';
    public $faq_meta_tags = '';

    protected $rules = [
        'home_meta_title' => 'nullable|string|max:255',
        'home_meta_description' => 'nullable|string',
        'home_meta_keywords' => 'nullable|string',
        'home_meta_tags' => 'nullable|string',
        'home_title' => 'nullable|string|max:255',
        'home_page_schema' => 'nullable|string',
        
        'about_meta_title' => 'nullable|string|max:255',
        'about_meta_description' => 'nullable|string',
        'about_meta_keywords' => 'nullable|string',
        'about_meta_tags' => 'nullable|string',
        'about_title' => 'nullable|string|max:255',
        'about_page_schema' => 'nullable|string',
        
        'contact_meta_title' => 'nullable|string|max:255',
        'contact_meta_description' => 'nullable|string',
        'contact_meta_keywords' => 'nullable|string',
        'contact_meta_tags' => 'nullable|string',
        'contact_title' => 'nullable|string|max:255',
        'contact_page_schema' => 'nullable|string',
        
        'service_meta_title' => 'nullable|string|max:255',
        'service_meta_description' => 'nullable|string',
        'service_meta_keywords' => 'nullable|string',
        'service_meta_tags' => 'nullable|string',
        'service_title' => 'nullable|string|max:255',
        'service_page_schema' => 'nullable|string',
        
        'products_meta_title' => 'nullable|string|max:255',
        'products_meta_description' => 'nullable|string',
        'products_meta_keywords' => 'nullable|string',
        'products_meta_tags' => 'nullable|string',
        'product_page_schema' => 'nullable|string',
        
        'faq_meta_title' => 'nullable|string|max:255',
        'faq_meta_description' => 'nullable|string',
        'faq_meta_keywords' => 'nullable|string',
        'faq_meta_tags' => 'nullable|string',
    ];

    public function mount()
    {
        $this->settings = PageMeta::first();
        
        if (!$this->settings) {
            $this->settings = PageMeta::create([]);
        }

        $this->loadSettings();
        $this->analyzeCurrentTab();
    }

    public function loadSettings()
    {
        $this->home_meta_title = $this->settings->home_meta_title;
        $this->home_meta_description = $this->settings->home_meta_description;
        $this->home_meta_keywords = $this->settings->home_meta_keywords;
        $this->home_meta_tags = $this->settings->home_meta_tags;
        $this->home_title = $this->settings->home_title;
        $this->home_page_schema = $this->settings->home_page_schema;

        $this->about_meta_title = $this->settings->about_meta_title;
        $this->about_meta_description = $this->settings->about_meta_description;
        $this->about_meta_keywords = $this->settings->about_meta_keywords;
        $this->about_meta_tags = $this->settings->about_meta_tags;
        $this->about_title = $this->settings->about_title;
        $this->about_page_schema = $this->settings->about_page_schema;

        $this->contact_meta_title = $this->settings->contact_meta_title;
        $this->contact_meta_description = $this->settings->contact_meta_description;
        $this->contact_meta_keywords = $this->settings->contact_meta_keywords;
        $this->contact_meta_tags = $this->settings->contact_meta_tags;
        $this->contact_title = $this->settings->contact_title;
        $this->contact_page_schema = $this->settings->contact_page_schema;

        $this->service_meta_title = $this->settings->service_meta_title;
        $this->service_meta_description = $this->settings->service_meta_description;
        $this->service_meta_keywords = $this->settings->service_meta_keywords;
        $this->service_meta_tags = $this->settings->service_meta_tags;
        $this->service_title = $this->settings->service_title;
        $this->service_page_schema = $this->settings->service_page_schema;

        $this->products_meta_title = $this->settings->products_meta_title;
        $this->products_meta_description = $this->settings->products_meta_description;
        $this->products_meta_keywords = $this->settings->products_meta_keywords;
        $this->products_meta_tags = $this->settings->products_meta_tags;
        $this->product_page_schema = $this->settings->product_page_schema;

        $this->faq_meta_title = $this->settings->faq_meta_title;
        $this->faq_meta_description = $this->settings->faq_meta_description;
        $this->faq_meta_keywords = $this->settings->faq_meta_keywords;
        $this->faq_meta_tags = $this->settings->faq_meta_tags;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->analyzeCurrentTab();
    }

    public function analyzeCurrentTab()
    {
        $analysis = $this->settings->analyzeSeoForPage($this->activeTab);
        $this->seoScore = $analysis['score'];
        $this->seoMetrics = $analysis['metrics'];
    }

    public function updated()
    {
        $this->analyzeCurrentTab();
    }

    public function save()
    {
        $this->validate();

        $this->settings->update([
            'home_meta_title' => $this->home_meta_title,
            'home_meta_description' => $this->home_meta_description,
            'home_meta_keywords' => $this->home_meta_keywords,
            'home_meta_tags' => $this->home_meta_tags,
            'home_title' => $this->home_title,
            'home_page_schema' => $this->home_page_schema,

            'about_meta_title' => $this->about_meta_title,
            'about_meta_description' => $this->about_meta_description,
            'about_meta_keywords' => $this->about_meta_keywords,
            'about_meta_tags' => $this->about_meta_tags,
            'about_title' => $this->about_title,
            'about_page_schema' => $this->about_page_schema,

            'contact_meta_title' => $this->contact_meta_title,
            'contact_meta_description' => $this->contact_meta_description,
            'contact_meta_keywords' => $this->contact_meta_keywords,
            'contact_meta_tags' => $this->contact_meta_tags,
            'contact_title' => $this->contact_title,
            'contact_page_schema' => $this->contact_page_schema,

            'service_meta_title' => $this->service_meta_title,
            'service_meta_description' => $this->service_meta_description,
            'service_meta_keywords' => $this->service_meta_keywords,
            'service_meta_tags' => $this->service_meta_tags,
            'service_title' => $this->service_title,
            'service_page_schema' => $this->service_page_schema,

            'products_meta_title' => $this->products_meta_title,
            'products_meta_description' => $this->products_meta_description,
            'products_meta_keywords' => $this->products_meta_keywords,
            'products_meta_tags' => $this->products_meta_tags,
            'product_page_schema' => $this->product_page_schema,

            'faq_meta_title' => $this->faq_meta_title,
            'faq_meta_description' => $this->faq_meta_description,
            'faq_meta_keywords' => $this->faq_meta_keywords,
            'faq_meta_tags' => $this->faq_meta_tags,
        ]);

        session()->flash('success', 'SEO settings updated successfully.');
    }

    public function render()
    {
        $overallHealth = $this->settings->getOverallSeoHealth();
        
        return view('livewire.admin.page-meta', [
            'overallHealth' => $overallHealth
        ]);
    }
}