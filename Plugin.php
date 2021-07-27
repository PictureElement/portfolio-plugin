<?php namespace Msof\Portfolio;

use System\Classes\PluginBase;
use Event;
use Backend;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Msof\Portfolio\Components\PortfolioList' => 'PortfolioList'
        ];
    }

    public function boot()
    {
        // 01. Add main menu item
        Event::listen('backend.menu.extendItems', function($manager) {
            $manager->addMainMenuItems('October.Cms', [
                'frontend_theme' => [
                    'label'         => 'Frontend Theme',
                    'url'           => Backend::url('cms/themeoptions/update'),
                    'icon'          => 'icon-image',
                    'permissions'   => ['cms.manage_themes', 'cms.manage_theme_options']
                ]
            ]);
        
        });
        
        // 02. Add models to a RainLab.Sitemap or RainLab.Pages menu
        Event::listen('pages.menuitem.listTypes', function () {
            return [
                'all-portfolio-projects' => 'All portfolio projects',
            ];
        });
        
        Event::listen('pages.menuitem.getTypeInfo', function ($type) {
            if ($type === 'all-portfolio-projects') {
                $theme = \Cms\Classes\Theme::getActiveTheme();
                $pages = \Cms\Classes\Page::listInTheme($theme, true);
                return [
                    'dynamicItems' => true,
                    'cmsPages' => $pages,
                ];
            }
        });
        
        Event::listen('pages.menuitem.resolveItem', function ($type, $item, $url, $theme) {
            if ($type === 'all-portfolio-projects') {
                return Project::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
