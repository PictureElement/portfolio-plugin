<?php namespace Msof\Portfolio\Components;

use Msof\Portfolio\Models\Project;
use Msof\Portfolio\Models\Category;
use System\Classes\CombineAssets;

class PortfolioList extends \Cms\Classes\ComponentBase {
    
    public function componentDetails() {
        return [
            'name' => 'Portfolio List',
            'description' => 'Displays a filterable Masonry portfolio.'
        ];
    }

    public function defineProperties() {
        return [
            'width' => [
                 'title'             => 'Width (src)',
                 'description'       => 'Width (1x only) of candidate image source for the user agent to use.',
                 'type'              => 'string',
                 'default'           =>  343,
                 'validationPattern' => '^[0-9]+$',
                 'validationMessage' => 'The Width (src) property can contain only numeric symbols',
                 'group'             => 'Responsive images'
            ],
            'widths' => [
                 'title'             => 'Widths (srcset)',
                 'description'       => 'Widths (1x only) of possible image sources for the user agent to use.',
                 'type'              => 'set',
                 'default'           => [343,288,332,245,262,184,158],
                 'group'             => 'Responsive images'
            ],
            'sizes' => [
                 'title'             => 'Sizes',
                 'description'       => 'Value for the image element\'s sizes attribute.',
                 'type'              => 'string',
                 'default'           => '(min-width: 1200px) 343px, (min-width: 992px) 288px, (min-width: 768px) 332px, (min-width: 576px) 245px, calc(48.46vw - 16px)',
                 'group'             => 'Responsive images'
            ]
        ];
    }

    public function onRun() {
        // Javascript
        $jsAssets = [
            'assets/vendor/jquery/dist/jquery.min.js',
            'assets/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
            'assets/vendor/simplebar/dist/simplebar.min.js',
            'assets/vendor/masonry-layout/dist/masonry.pkgd.min.js',
            'assets/vendor/imagesloaded/imagesloaded.pkgd.min.js',
            'assets/js/portfolio-list.js'
        ];
        $this->addJs(CombineAssets::combine($jsAssets, plugins_path('msof/portfolio/')));
        
        // CSS
        $cssAssets = [
            'assets/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
            'assets/vendor/simplebar/dist/simplebar.min.css',
            'assets/sass/_variables.scss',
            'assets/sass/portfolio-list.scss'
        ];
        $this->addCss(CombineAssets::combine($cssAssets, plugins_path('msof/portfolio/')));
        
        // Initial state
        $this->page['projects'] = $this->projects([]);
        $this->page['categories'] = $this->categories();
    }
    
    public function onFilter() {
        $categoryId = input('categoryId');
        if ($categoryId == '0') {
            $projects = Project::ListFrontEnd([]);
        } else {
            $projects = Project::ListFrontEnd(['category' => $categoryId]);
        }
        $this->page['projects'] = $projects;
        return [
            '#portfolioListStage' => $this->renderPartial('PortfolioList::stage')
        ];
    }
    
    public function onModal() {
        $projectId = input('projectId');
        $project = Project::find($projectId);
        $this->page['project'] = $project;
        return [
            '#portfolioListModalTitle' => $this->renderPartial('PortfolioList::modal-title'),
            '#portfolioListModalText' => $this->renderPartial('PortfolioList::modal-text')
        ];
    }
    
    // Categories w. at least one published project
    public function categories() {
        $categories = Category::whereHas('projects', function ($query) {
            $query->where('published', 1);
        })->get();
        return $categories;
    }
    
    // Projects
    public function projects($options) {
        $projects = Project::ListFrontEnd($options);
        return $projects;
    }
}