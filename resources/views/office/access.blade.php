@extends('layouts.app')
@section('content')
<div class="container" style="overflow: auto">
    @foreach ($offices as $office)

   <div  class="card mb-4 shadow-sm"   >
       <div class="card-header">
         <h4 class="my-0 font-weight-normal">{{$office->email}}</h4>
       </div>
       <div class="card-body">
         <h1 class="card-title pricing-card-title">{{$office->name}} </h1>
         @if( !$office->accessRequests->where('user_id',$logged->id)->first())
         <form method="post" action="{{route('send.access.request',$office->id)}}">
            @csrf
       <button type="submit"  class="btn btn-lg btn-block btn-outline-primary" @if( $logged->accessRequests->first() && $logged->accessRequests->first()->office_id !== $office->id) disabled @endif>   Posalji zahtjev za pristup</button>
    </form>
       @else
       <form method="post" action="{{route('cancel.access.request',$office->id)}}">
        @csrf
       <button type="submit"  class="btn btn-lg btn-block btn-outline-primary" @if( $logged->accessRequests->first() && $logged->accessRequests->first()->office_id !== $office->id) disabled @endif>Ponisti zahtjev</button>
    </form>

        @endif
       </div>
   </div>

   @endforeach

</div>
@endsection
