<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function readNotifications(){
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();

        return ['status' => 'success'];
    }
    public function markReadNotification(Request $request){
        $notification = auth()->user()->notifications()->find($request->id);
if($notification) {
    $notification->markAsRead();
}
        return ['status' => 'success'];

    }

    public function loadMoreNotifications(Request $request){
        $user = Auth::user();
        $notifications = $user->notifications();

        $total = $notifications->count();
        $notifications = $notifications->latest()->skip($request->loaded)->take(10)->get();

        return ['status' => 'success', 'notifications' => $notifications, 'total' => $total];
    }
    public function indexNotifications(){
        $response = $this->selectNotifications(0, '');
        $notifications = $response['notifications'];
        $count = $response['count'];

        return view('notifications.index', compact('notifications', 'count'));
    }

    public function tableNotifications(Request $request){
        $response = $this->selectNotifications($request->page, trim($request->search));
        $notifications = $response['notifications'];
        $count = $response['count'];

        return ['status' => 'success', 'values' => $notifications, 'count' => $count];
    }
    public function selectNotifications($page,$search){
        $user = Auth::user();
        $notifications = $user->notifications();

        if(!empty(trim($search))){
            $notifications = $notifications->where(function($query) use ($search){
                $query->where('data','like','%'.$search.'%');
            });
        }

        $count = $notifications->count();

        $notifications = $notifications->skip($page * 30)->take(30)->get();

        $page_count = $count % 30 > 0 ? intval($count / 30) + 1 : intval($count / 30);

        return ['notifications' => $notifications,'count' => $page_count];
    }
}
