<?php

namespace App\Layouts;

use Orchid\Platform\Fields\Field;
use Orchid\Platform\Layouts\Rows;

class ProfilePasswordLayout extends Rows
{
    /**
     * Views
     *
     * @return array
     * @throws \Orchid\Platform\Exceptions\TypeException
     */
    public function fields(): array
    {
        return [
            Field::tag('password')
                ->name('profile.password')
                ->required()
                ->title('Введите пароль'),

            Field::tag('password')
                ->name('profile.password_confirmation')
                ->required()
                ->title('Повторите пароль')
                ->hr(false),

        ];
    }
}
