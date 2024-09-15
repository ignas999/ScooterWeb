@extends('components.layout')

@section('content')
    
<h2 class="reviews-header">Įvertinimai modelio {{ $transport->name }}</h2>
<div class="imagebox">
<img class="imageformat" src="{{ asset('images/transports/' . $transport->image) }}"</>
</div>
<div class="button-container">
    <a href="/addrating/{{$transport->transport_id}}" class="write-review-button">Palikite atsiliepimą</a>
</div>

    @if ($ratings->isEmpty())
    <div class="reviews-container">

        
        
        <div class="review-card">
            <div class="review-header">
             
                <span class="rating">Nėra įvertinimų</span>
            </div>
        </div>

    @else
        <div class="reviews-container">

            @foreach ($ratings as $rating)
            
            <div class="review-card">
                <div class="review-header">
                    @if($rating->user->user_id == auth()->user()->user_id)
                    <span class="user-name , red"> {{ $rating->user->username }} (Jūsų įvertinimas)</span>
                    @else
                    <span class="user-name"> {{ $rating->user->username }}</span>
                    @endif
                    <span class="rating">Įvertinimas: {{ $rating->rating_score }}</span>
                </div>
                @if ($rating->comment != "")
                    <div class="comment">
                        <p>Komentaras: </p>
                        {{ $rating->comment }}
                    </div>
                @endif
            </div>
            @endforeach
        
        </div>
    
    @endif
@if($ratings_count > 2)
    <div class="pagination" >

        {{ $ratings->links() }}
    </div>
@endif


@endsection