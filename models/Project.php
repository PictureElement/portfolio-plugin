<?php namespace Msof\Portfolio\Models;

use Model;
use ValidationException;
use Carbon\Carbon;

/**
 * Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'msof_portfolio_projects';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title'   => 'required',
        'slug'    => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:msof_portfolio_projects'],
        'category' => 'required',
        'preview_image' => 'required',
        'text' => 'required'
    ];
    
    public function afterValidate() {
        if ($this->published && !$this->published_at) {
            throw new ValidationException([
               'published_at' => 'Please specify the published date'
            ]);
        }
    }
    
    /**
     * Relations
     */
    public $belongsTo = [
        'category' => 'Msof\Portfolio\Models\Category'
    ];
     
    public $attachOne = [
        'preview_image' => [\System\Models\File::class]
    ];
    
    /**
     * Handler for the Pages and Sitemap plugins
     * Returns information about a menu item.
     */
    public static function resolveMenuItem($item, $url, $theme) {
        $pageName = $item->cmsPage;
        $cmsPage = \Cms\Classes\Page::loadCached($theme, $pageName);
        $items   = self
            ::orderBy('created_at', 'DESC')
            ->get()
            ->map(function (self $item) use ($cmsPage, $url, $pageName) {
                $pageUrl = $cmsPage->url($pageName, ['slug' => $item->slug]);
    
                return [
                    'title'    => $item->name,
                    'url'      => $pageUrl,
                    'mtime'    => $item->updated_at,
                    'isActive' => $pageUrl === $url,
                ];
            })
            ->toArray();
    
        return [
            'items' => $items,
        ];
    }
    
    /**
     * Scopes
     */
     
    public function scopeIsPublished($query) {
        return $query
            ->whereNotNull('published')
            ->where('published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<', Carbon::now());
    }
    
    public function scopeListFrontEnd($query, $options) {
        
        // Default options
        extract(array_merge([
            'page' => 1,
            'perPage' => 100,
            'sort' => 'sort_order',
            'category' => null,
            'published' => true
        ], $options));
        
        if ($published) {
            $query->isPublished();
        }
        
        if ($category !== null) {
            $query->where('category_id', '=', $category);
        }
        
        /*
         * Sorting
         */
        @list($sortField, $sortDirection) = explode(' ', $sort);
        if (is_null($sortDirection)) {
            $sortDirection = "asc";
        }
        $query->orderBy($sortField, $sortDirection);
        
        return $query->paginate($perPage, $page);
    }
}
