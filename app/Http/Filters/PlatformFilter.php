<?php

namespace App\Http\Filters;

use App\History;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Platform\Fields\Field;
use Orchid\Platform\Filters\Filter;

class PlatformFilter extends Filter
{

    /**
     * @var array
     */
    public $parameters = [
        'platform'
    ];

    /**
     * @var bool
     */
    public $display = true;

    /**
     * @var bool
     */
    public $dashboard = true;

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('platform', $this->request->get('platform'));
    }

    /**
     * @return mixed|void
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function display() : Field
    {
        $platform = History::select('platform')->groupBy('platform')->pluck('platform','platform');

        return Field::tag('select')
            ->options($platform)
            ->value($this->request->get('platform'))
            ->name('platform')
            ->title('Платформа')
            ->hr(false);
    }
}
