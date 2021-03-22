<?php

namespace App\Http\Controllers;

use App\Http\Requests\LegalEntitiesRequest;
use App\Http\Requests\NaturalPeopleRequest;
use App\Models\AccessRequest;
use App\Models\LegalEntity;
use App\Models\NaturalPeople;
use App\Models\Office;
use App\Models\User;
use App\Notifications\NewAccessRequest;
use App\Notifications\OfficeDeleted;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class OfficeController extends Controller
{
    //
    public function show(){
        return view('office.create');
    }
    public function deleteOffice(Request $request){
        $user=Auth::user();
        if(Hash::check($request->password,$user->password)){
            $office=$user->office;
            $members=User::where('office_id',$office->id)->get();
            FacadesNotification::send($members,new OfficeDeleted($office));
            User::where('office_id',$user->office->id)->update(['office_id' => NULL]);
            $user->office->delete();
            session()->flash('notification','Izbrisali ste vasu kancelariju!');
            session()->flash('alert-class', 'alert-success');


        }
        return view('home');

    }
    public function create(Request $request){
        $user=Auth::user();
         $inputs = request()->validate([
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required','max:30'],
            'fax' => ['required','max:30'],
            'email' => ['required','max:120','email'],
        ]);

        $user->office()->create($inputs);
        $office=$user->office;
        User::where('id',$user->id)->update(['office_id' => $office->id]);

         return view('home');
    }
    public function showAddWorkers(){
        return view('office.workers');
    }
    public function addWorker(Request $request){
        $inputs=request()->validate([
            'name'=>['required','string','max:255' ],
            'email'=>['required','email','max:255' ],
         ]);
            $office=Auth::user()->office;
         $data=[
            'name' => $inputs['name'],
             'email' => $inputs['email'],
             'office' => $office,
        ];

        Mail::send('email.request', $data, function ($message) use ($data) {
            $message->from('trivicdusan94@gmail.com', 'Dusan Trivic');
            $message->sender('trivicdusan94@gmail.com', 'Dusan Trivic');
            $message->to($data['email'], $data['name'])->subject('Hello');;

        });

        return  redirect()->route('office.workers');

    }
    public function acceptRequestfromOffice($email,$office_id){
           $user=User::where('email',$email)->update(['office_id' => $office_id]);
           return view('home');
          }

    public function showHome(){
        return view('office.home');

          }
    public function showEdit(){
              $office= Auth::user()->office;
              $workers=$office->workers;
               return view('office.edit',['office'=>$office , 'workers' => $workers]);
          }
    public function leaveOffice(Request $request){
        $user=Auth::user();
        $office=$user->isInOffice;
        if($office->user_id == $user->id){
            session()->flash('notification','Admin ne moze napustiti kancelariju');
            session()->flash('alert-class', 'alert-danger');

             return view('home') ;
        }
        if(Hash::check($request->password,$user->password)){
            User::where('id',$user->id)->update(['office_id' => NULL]);

            session()->flash('notification','Nisi vise clan kancelarije '.$office->name);
            session()->flash('alert-class', 'alert-success');

        }
        return view('home') ;

    }

    public function removeWorker($id){
        if(Auth::user()->id == $id){
            session()->flash('notification','Vi ste admin i ne mozete napustiti kancelariju!');
            session()->flash('alert-class', 'alert-danger');
            return  redirect()->route('office.edit');

        }
              $user= User::where('id',$id)->update(['office_id' => NULL]);
             return  redirect()->route('office.edit');
        }
    public function showOffices(){
        $offices=Office::all();
         return view('office.access',['offices'=>$offices]);
    }
    public function sendAccessRequest($office_id){
        $user=Auth::user();
        $office=Office::findOrFail($office_id);
         $admin=User::where('id',$office->user_id)->get();
              if(AccessRequest::where('user_id',$user->id)->where('office_id',$office_id )->first()|| $user->office_id == $office_id){
                return redirect()->route('show.offices');
            }
          AccessRequest::create([
            'user_id' => $user->id,
            'office_id' => $office_id,
         ]);
         FacadesNotification::send($admin,new NewAccessRequest($user));

         return redirect()->route('show.offices');
    }
    public function cancelAccessRequest($office_id){
        $user=Auth::user();
        $office=Office::findOrFail($office_id);
         $admin=User::where('id',$office->user_id)->first();
              if(!AccessRequest::where('user_id',$user->id)->where('office_id',$office_id )->first()|| $user->office_id == $office_id){
                return redirect()->route('show.offices');
            }
            AccessRequest::where('user_id',$user->id)->where('office_id',$office_id )->first()->delete();
            $admin->notifications()->where('type','App\Notifications\NewAccessRequest')->where('data->email', $user->email)->first()->delete();

         return redirect()->route('show.offices');
    }
    public function accessRequests(){
        $user=Auth::user();
        $office=$user->office;
        $ids=[];
        $access_requests=$office->accessRequests;
        foreach($access_requests as $request){
            array_push($ids,$request->user_id);
        }
        $users=User::whereIn('id',$ids)->get();
          return view('office.access_requests',['users'=>$users]);

    }

    public function acceptRequestfromUser($user_id){
        $admin=Auth::user();
        $office=$admin->office;
        $user=User::where('id',$user_id)->update(['office_id' => $office->id]);
        $access_requests=AccessRequest::where('user_id',$user_id)->where('office_id',$office->id)->delete();

        return redirect()->route('office.access.requests');
        }

    public function declineRequestfromUser($user_id){
        $admin=Auth::user();
        $office=$admin->office;
        AccessRequest::where('user_id',$user_id)->where('office_id',$office->id)->delete();

                // $user->notifications()
                //     ->where('id', $request->notification_id) // and/or ->where('type', $notificationType)
                //     ->get()
                //     ->first()
                //     ->delete();
                return redirect()->route('office.access.requests');

            }
    public function showDirectory(){
      return view('office.directory');

      }
    public function storeNatural(NaturalPeopleRequest $request){
        $user=Auth::user();
         $office=$user->office;
         $request['office_id']=$office->id;
         NaturalPeople::create($request->all());
         return back();

      }
      public function storeLegalEntities(LegalEntitiesRequest $request){
        $user=Auth::user();
        $office=$user->office;
        $request['office_id']=$office->id;
         LegalEntity::create($request->all());
        return back();

     }
     public function searchClients(Request $request){
        $user=Auth::user();
        $office=$user->office;

        if($request['type'] == 'natural_people'){

                 $clients=NaturalPeople::where('office_id',$office->id)->where(function ($query) use($request) {
                    if($request['first_name'] == ''){
                        return $query;
                    }
                   return  $query->where('first_name',$request['first_name']);
                })->where(function ($query) use($request) {
                     if($request['last_name'] == ''){
                        return $query;
                     }
                    return $query->where('last_name',$request['last_name']);
                })->where(function ($query) use($request) {
                    if($request['jmbg'] == ''){
                       return $query;
                    }
                   return $query->where('jmbg',$request['jmbg']);
               })->where(function ($query) use($request) {
                if($request['place'] == ''){
                   return $query;
                }
               return $query->where('place',$request['place']);
           })->get();
                return response()->json($clients);


             return response()->json($clients);
        }
         if($request['type'] == 'legal_entity'){
            $clients=LegalEntity::where('office_id',$office->id)->where(function ($query) use($request) {
                if($request['name'] == ''){
                    return $query;
                }
               return  $query->where('name',$request['name']);
            })->where(function ($query) use($request) {
                 if($request['place'] == ''){
                    return $query;
                 }
                return $query->where('place',$request['place']);
            })->where(function ($query) use($request) {
                if($request['jib'] == ''){
                   return $query;
                }
               return $query->where('jib',$request['jib']);
           })->get();
            return response()->json($clients);
        }
     }
}
