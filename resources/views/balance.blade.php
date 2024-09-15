@extends('components.layout')

@section('content')


 <h1 class="bold center">Balanso istorija</h1>
 <h2 class="center">Norėdami papildyti balansą turite atvykti gyvai.</h2>

<div class="balanceform">

    @foreach ($userbalance as $one)

    <div class="balancebox">
    <p> {{ 'Mokėjimo Numeris: ' . $one->transaction_id }}</p>
    <p> {{ 'Suma: ' . $one->amount .' eur'}}</p>
    <p> {{ 'Papildymo data: ' . $one->date }}</p>
    </div>

            
        
    

@endforeach
</div>


@endsection