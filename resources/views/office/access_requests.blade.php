@extends('layouts.app')
@section('content')
<div class="container" style="overflow: auto">
    @foreach ($users as $user)
   <div  class="card mb-4 shadow-sm  "  >
       <div class="card-header">
         <h4 class="my-0 font-weight-normal">{{$user->email}}</h4>
       </div>
       <div class="card-body">
         <h1 class="card-title pricing-card-title">{{$user->name}} </h1>
         <form method="post" action="{{route('accept.request.from.office',$user->id)}}">
            @csrf
       <button type="submit"  class="btn btn-lg btn-block btn-outline-primary">Prihvati</button>
    </form>
    <form method="post" action="{{route('decline.request.from.office',$user->id)}}">
        @csrf
   <button type="submit"  class="btn btn-lg btn-block btn-outline-primary">Odbaci</button>
</form>
       </div>
   </div>

   @endforeach

</div>
@endsection
