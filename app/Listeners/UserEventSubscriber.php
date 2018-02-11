<?php

namespace App\Listeners;
use App\History;
use Jenssegers\Agent\Agent;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {

        $agent = new Agent();

        $browser = $agent->browser();
        $browser_version = $agent->version($browser, 'unknown');

        $platform = $agent->platform();
        $platform_version = $agent->version($platform, 'unknown');

        $history = new History([
            'platform'         => $platform,
            'platform_version' => $platform_version,
            'browser'          => $browser,
            'browser_version'  => $browser_version,
            'address'          => request()->getClientIp(),
        ]);
        $event->user->history()->save($history);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );
    }

}
