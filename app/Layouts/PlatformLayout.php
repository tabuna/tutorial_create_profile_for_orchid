<?php

namespace App\Layouts;

use Orchid\Platform\Layouts\Chart;

class PlatformLayout extends Chart
{

    /**
     * @var string
     */
    public $title = 'Используемые платформы';

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
        'Операционные системы',
    ];

    /**
     * @var string
     */
    public $data = 'statistics.platform';
}
