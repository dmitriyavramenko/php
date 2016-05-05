<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Services\User\StatusService;

class StatusController extends UserBaseController
{
    /**
     * Show Status default page
     *
     * @return view
     */
    public function getIndex( StatusService $statusService )
    {
        $statusService->setModel('status');
        $statuses = $statusService->findAll($this->user);
        return view('users/statuses/index',['statuses'=>$statuses]);
    }
    
    /**
     * Create status
     *
     * @return view
     */
    public function postCreate( StatusService $statusService )
    {
        $statusService->setModel('status');
        $data = request()->except('_token');
        $data['user_id'] = $this->user->id;
        $status = $statusService->create($data,$this->user);
        if($status)
            return back()->with('success','Successfuly created');
        return back()->with('success','Can not create status');
    }
    
    /**
     * Delete status
     *
     * @return view
     */
    public function deleteDelete( StatusService $statusService, $id)
    {
        $statusService->setModel('status');
        if($statusService->delete( $id, $this->user ))
            return back()->with('success','Successfuly delete');
        return back()->withErrors('Can not delete');
    }

    /**
     * Show update status form
     *
     * @return view
     */
    public function getUpdate( StatusService $statusService, $id )
    {
        $statusService->setModel('status');
        return view('users/statuses/update',['model'=>$statusService->findByPk($id,$this->user)]);
    }

    /**
     * Update status
     *
     * @return view
     */
    public function postUpdate( StatusService $statusService, $id)
    {
        $statusService->setModel('status');
        $data = request()->except('_token');
        if($statusService->update($id, $data, $this->user))
            return redirect('user/status')->with('success', 'Successfuly updated');
        return back()->withErrors('Can not update status');
    }

    /**
     * Create status reply
     *
     * @return view
     */
    public function postCreateReply( StatusService $statusService )
    {
        $statusService->setModel('statusReply');
        $data = request()->except('_token');
        $data['user_id'] = $this->user->id;
        $status = $statusService->create($data,$this->user);
        if($status)
            return back()->with('success','Successfuly created');
        return back()->with('success','Can not create status');
    }
}