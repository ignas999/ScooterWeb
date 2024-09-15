@extends('components.layout')

@section('content')

<div class="ratings_box">
<h1>Jūsų įvertinimai</h1>
@if(count($Ratings) == 0)
    <div class="rating_field">
        <p>Neturite Parašę atsiliepimų</p>
    </div>
@else
@foreach ($Ratings as $rating)
    <div class="rating_field">


    <p>Modelis: {{ $rating->transport->name }}</p>
    <img class="imageformat" src="{{ asset('images/transports/' . $rating->transport->image) }}"</>
    <p>Įvertinimas: {{ $rating->rating_score }} balai</p>
    <p>Komentaras: {{ $rating->comment }}</p>

    <form action="rating/delete/{{ $rating->rating_id}}" method="POST">
    @csrf
    @method('DELETE')
    <button class="deleterating">Ištrinti</button>

    </form>


    </div>

    
    @endforeach
@endif

</div>



@endsection