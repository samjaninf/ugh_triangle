<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class MainLayoutComposer
{

    private $user;
    private $notificationCount;

    public function __construct()
    {
        $this->user = \Auth::user();
        $this->notificationCount = $this->user->getNotificationsCount();
    }

    public function compose(View $view)
    {
        $view->with('user', $this->user);
        $view->with('notificationsCount', $this->notificationCount);
    }

}