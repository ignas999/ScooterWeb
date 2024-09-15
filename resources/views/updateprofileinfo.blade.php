@extends('components.layout')

@section('content')
<div class="profileform">
    
    <div class="profilebox">
        <h1 class="bold">Atnaujinti profilio informacija</h1>
        <p>Jeigu norite atnaujinti duomenis , privalote užpildyti telefono numerį</p>
<form action="profileinfo" method="POST">
    @csrf

    <label> Paskyros Vardas </label>
    <input type="text" name="username" value="{{ auth()->user()->username }}">
    @error('username')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label> Email </label>
    <input type="email" name="email" value="{{ auth()->user()->email }}">
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label> Telefono Numeris </label>
    <input type="tel" name="phone" value="{{ auth()->user()->phone }}" placeholder="3706xxxxxxx">
    @error('phone')
    <div class="alert alert-danger">{{ $message}}</div>
    @enderror

    <button class="cancelorder">Atnaujinti</button>


    


</form>
    </div>
</div>
@endsection