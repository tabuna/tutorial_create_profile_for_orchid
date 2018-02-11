<?php

namespace App\Http\Filters;

use App\History;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Platform\Fields\Field;
use Orchid\Platform\Filters\Filter;

class BrowserFilter extends Filter
{

    /**
     * @var array
     */
    public $parameters = [
        'browser'
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
        return $builder->where('browser', $this->request->get('browser'));
    }

    /**
     * @return mixed|void
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function display() : Field
    {
        $browsers = History::select('browser')->groupBy('browser')->pluck('browser','browser');

        return Field::tag('select')
            ->options($browsers)
            ->value($this->request->get('browser'))
            ->name('browser')
            ->title('Браузер')
            ->hr(false);
    }
}
