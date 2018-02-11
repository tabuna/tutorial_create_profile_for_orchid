<?php

namespace App\Layouts;

use Orchid\Platform\Layouts\Chart;

class BrowserLayout extends Chart
{

    /**
     * @var string
     */
    public $title = 'Используемые браузеры';

    /**
     * @var int
     */
    public $height = 200;

    /**
     * Available options:
     * 'bar', 'line', 'scatter',
     * 'pie', 'percentage'
     *
     * @var string
     */
    public $type = 'bar';

    /**
     * @var array
     */
    public $labels = [
        'Браузеры',
    ];

    /**
     * @var string
     */
    public $data = 'statistics.browser';
}
