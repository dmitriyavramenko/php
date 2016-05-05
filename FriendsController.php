<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Services\User\FriendService;

class FriendsController extends UserBaseController
{
    /**
     * Show Settings default page
     * 
     * @return view
     */
    public function getIndex( FriendService $friendService )
    {
        return view('users/friends/index',['firendsList'=>$this->user->firendsList()]);
    }

    /**
     * Send request
     *
     * @param FriendService $friendService
     * @return json|back
     */
    public function postSendRequest( FriendService $friendService )
    {
        if(request()->ajax())
        {
            if($sentRequest = $friendService->saveSentRequest($this->user->id, request()->get('user_id')))
                return response()->json(['success'=>true,'sentRequest'=>$sentRequest]);
            return response()->json([ 'success'=>false, 'message' => 'Can`t send request' ]);
        }
        return back()->with('notice','Something wet wrong!!!');
    }

    /**
     * Accept request
     *
     * @param FriendService $friendService
     * @return json|back
     */
    public function postAcceptRequest( FriendService $friendService )
    {
        if(request()->ajax())
        {
            return response()->json($friendService->acceptRequest($this->user->id, request()->get('user_id')));
        }
        return back()->with('notice','Something wet wrong!!!');
    }

    /**
     * Cancel request
     *
     * @param FriendService $friendService
     * @return json|back
     */
    public function postCancelRequest( FriendService $friendService )
    {
        if(request()->ajax())
        {
            return response()->json($friendService->cancelRequest($this->user->id, request()->get('user_id')));
        }
        return back()->with('notice','Something wet wrong!!!');
    }

    /**
     * Unfriend request
     *
     * @param FriendService $friendService
     * @return json|back
     */
    public function postUnfriend( FriendService $friendService )
    {
        if(request()->ajax())
        {
            return response()->json($friendService->unfriend($this->user->id, request()->get('user_id')));
        }
        return back()->with('notice','Something wet wrong!!!');
    }
}