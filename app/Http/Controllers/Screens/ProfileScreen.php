<?php

namespace App\Http\Controllers\Screens;

use App\History;
use App\Http\Filters\BrowserFilter;
use App\Http\Filters\PlatformFilter;
use App\Http\Requests\ChangePassword;
use App\Layouts\BrowserLayout;
use App\Layouts\HistoryLayout;
use App\Layouts\PlatformLayout;
use App\Layouts\ProfileLayout;
use App\Layouts\ProfilePasswordLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

class ProfileScreen extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Профиль';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Полное управление пользователем в одном месте';

    /**
     * Query data
     *
     * @return array
     */
    public function query(): array
    {
        $profile = Auth::user();
        $history = History::where('user_id', $profile->id)->filtersApply([
            BrowserFilter::class,
            PlatformFilter::class,
        ])->paginate();
        $statistics = [
            'browser'  => History::getStatisticsColumns("browser"),
            'platform' => History::getStatisticsColumns("platform"),
        ];

        return compact('profile', 'history', 'statistics');
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar(): array
    {
        return [
            Link::name('Изменить пароль')
                ->modal('password')
                ->title('Смена пароля')
                ->method('changePassword'),
            Link::name('Обновить профиль')
                ->method('update')
        ];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layouts::columns([
                'Профиль пользователя' => [
                    ProfileLayout::class,
                    Layouts::columns([
                        [PlatformLayout::class],
                        [BrowserLayout::class],
                    ])
                ],
                'История'              => [
                    HistoryLayout::class,
                ],
            ]),
            Layouts::modals([
                'password' => [
                    ProfilePasswordLayout::class
                ],
            ])
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Auth::user()->fill($request->get('profile'))->save();

        Alert::info('Профиль успешно обновлён');
        return redirect()->back();
    }

    /**
     * @param ChangePassword $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePassword $request)
    {
        Auth::user()->password = Hash::make($request->input('profile.password'));
        Auth::user()->save();

        Alert::info('Ваш пароль успешно изменён');
        return redirect()->back();
    }
}
