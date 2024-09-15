@extends('components.layout')


@section('content')
    

<x-sortcategories :categories="$categories" /> 

<div class="margincontent displayTransport">

    @if($available_transports->isEmpty())
        <p>Transporto priemonių šiuo metu nėra</p>
    @else
         @foreach ($available_transports as $single)
         @if($single->status_id != 15)
         <div class="box_text">
            @if($single->image != "")
                <img src="{{asset('images/transports/'. $single->image)}}" style="height: 9vw;">
            @else
            <img src="images/loading.jpg" style="height: 9vw;">
            @endif
             <h1 class="text-green-500">{{ $single->name }}</h1>
             <p>Būsena: {{ $single->status->name }}</p>
             <p>Kategorija: {{ $single->category->name }}</p>
            
             @if($single->status_id == 1)
             <a href="/orders/{{ $single->transport_id }}" class="redbutton">Rezervuoti</a>
             @endif
             <a href="/ratings/transport/{{ $single->transport_id }}" class="redbutton">Klientų įvertinimai</a>
            
         
            </div>
            @endif
         @endforeach
    @endif


</div>

@if ($transport_count > 4)
<div class="pagination" >

    {{ $available_transports->links() }}
</div>
@endif





@endsection