@extends('layouts.app')
@section('content')

<h1>User Profile of: {{$user->name}}</h1>
<div class="row" style="margin-left: 5px">



<form   method="post" action="" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-4">
    @if(Auth::user()->profile_photo)
    <img class="img-profile rounded-circle" style="max-width:50%; height:200px" src="">
    @else
    <img class="img-profile rounded-circle" style="max-width:50%; height:200px" src="{{url('/images/blank-profile-picture-973460_640.png')}}">
@endif
</div>
<div class="form group">
    <input type="file" name="avatar" >
</div>
<div class="form-group">
    <label for="first_name">Name</label>
<input type="text"
 name="first_name"
  class="form-control  "
   id="first_name"
   value="@if($user->name){{$user->name}}
   @endif">



</div>




</div>
<div class="form-group">
<label for="email">Email</label>
<input type="text"
name="email"
class="form-control"
id="email"
value="@if($user->email){{$user->email}}
@endif" >



</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password"
name="password"
class="form-control"
id="password"

>



</div>
<div class="form-group">
<label for="new-password">New Password</label>
<input type="password"
name="new_password"
class="form-control"
id="new_password"
>



</div>
<div class="form-group">
    <label for="password-confirmation">New Password Confirm</label>
    <input type="password"
    name="password_confirmation"
    class="form-control"
    id="password_confirmation"
    >



    </div>


<button type="submit" class="btn btn-primary">Submit</button>

</form>



</div>
</div>



@endsection
