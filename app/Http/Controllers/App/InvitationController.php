<?php
namespace App\Http\Controllers\App;

use App\Contracts\InvitationRepositoryInterface as InvitationRepository;
use App\Http\Controllers\Controller;
use App\Invitation;

class InvitationController extends Controller
{

    /*
     * Accepts the invitation request
     * @param $id
     * @param InvitationRepository $repository
     * @return mixed
     */
    public function accept($id, InvitationRepository $repository)
    {
        $invitation = Invitation::findOrFail($id);
        $repository->accept($invitation);
        return \Redirect::back()->with('success', 'Успешно стана част от екипа на ' . $invitation->sender->name);
    }


    /*
     * Accepts the invitation request
     * @param $id
     * @param InvitationRepository $repository
     * @return mixed
     */
    public function decline($id, InvitationRepository $repository)
    {
        $invitation = Invitation::findOrFail($id);
        $repository->decline($invitation);
        return \Redirect::back()->with('success', 'Ти отказа да станеш част от екипа на ' . $invitation->sender->name);
    }

}