<?php

namespace App\Http\Composer;

use Orchid\Platform\Kernel\Dashboard;

class MenuComposer
{
    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     *
     */
    public function compose()
    {
        $this->dashboard->menu->add('Main', [
            'slug'   => 'profile',
            'icon'   => 'icon-user',
            'route'  => route('dashboard.screens.profile'),
            'label'  => 'Профиль',
            'childs' => false,
            'main'   => true,
            'sort'   => 6000,
        ]);
    }
}
