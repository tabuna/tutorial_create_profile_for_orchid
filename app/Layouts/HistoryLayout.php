<?php

namespace App\Layouts;

use App\Http\Filters\BrowserFilter;
use App\Http\Filters\PlatformFilter;
use Orchid\Platform\Layouts\Table;
use Orchid\Platform\Platform\Fields\TD;

class HistoryLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'history';

    /**
     * @return array
     */
    public function filters() : array
    {
        return [
            BrowserFilter::class,
            PlatformFilter::class,
        ];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            TD::name('created_at')
                ->title('Дата входа')
                ->width('150px')
                ->setRender(function ($item){
                return $item->created_at->toDateString();
            }),

            TD::name('address')
                ->width('150px')
                ->title('IP Адрес'),


            TD::name('platform')
                ->width('200px')
                ->title('Платформа')
                ->setRender(function ($item){
                $platform_version = $item->platform_version;
                if(!$platform_version || $platform_version === 'unknown'){
                    $platform_version = "";
                }

                return "{$item->platform} {$platform_version}";
            }),

            TD::name('browser')
                ->title('Браузер')
                ->setRender(function ($item){
                return "{$item->browser} {$item->browser_version}";
            }),
        ];
    }
}
