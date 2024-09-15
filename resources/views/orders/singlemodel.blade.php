@extends('components.layout')

@section('content')

<div class="product_box-1 container-1 dashboardothers-1 listing-1">
    <h3>Modelio informacija</h3>
    <figure><img src="{{ asset("images/transports/". $transport->image) }}" style="height: 240px;" alt="#"/></figure>
    <div class="orderinfobox-1">
        <div class="orderinfo-1"><h3>Modelio pavadinimas: </h3> {{ $transport->name }}</div>
        <div class="orderinfo-1"><h3>Galingumas: </h3> {{ $transport->rated_power . 'kW'}}</div>
        <div class="orderinfo-1"><h3>Greitis: </h3> {{ $transport->max_speed . 'km/h'}}</div>
        <div class="orderinfo-1"><h3>Nuvažiuojamas Atstumas: </h3> {{ $transport->distance  . ' km'}} </div>
        <div class="orderinfo-1"><h3>Yra šiame nuomos punkte: </h3> {{ $transport->location->city . ' , ' . $transport->location->street }}</div>
        <div class="orderinfo-1"><h3>Nuomos kaina: </h3> {{ $transport->price . 'Eur/Val' }} </div>
        <div class="orderinfo-1"><h3>Aprašymas: </h3> {{ $transport->description }} </div>
    </div>
</div>

<div class="loginform-1 listing-1 orderinfobox-1">
    <form method="POST" class="signup-form-1" action="/orders/makeorder">
        @csrf
        {{ session(['user_id' => auth()->user()->user_id , 'transport_id' => $transport->transport_id ]); }}

        <h2 class="form-title-1">Užsakymo informacija</h2>
        <p> Minimalus rezervacijos laikas 1 valanda</p>
        <label> Pradžios laikas </label>
        <div class="form-group-1">
            <input type="datetime-local" class="form-input-1" name="start_date"/>
            @error('start_date')
                {{ 'Privaloma' }}
            @enderror
        </div>
        <label> Pabaigos laikas </label>
        <div class="form-group-1">
            <input type="datetime-local" class="form-input-1" name="end_date"/>
            @error('end_date')
                {{ 'Privaloma' }}
            @enderror
        </div>
        <div class="form-group-1">
            <input type="submit" name="submit" id="submit" class="form-submit-1" value="Rezervuoti"/>
        </div>
    </form>
</div>
@endsection