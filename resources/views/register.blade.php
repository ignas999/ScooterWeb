@extends('components.layout')


@section('content')
<div class="three_box">
    <div class="container margincontent">
       <div class="loginform">
             <div class="box_text">
               
                <form action="/register" method="POST" id="signup-form" class="signup-form">
                    @csrf
                    <h2 class="form-title">Užsiregistruokite</h2>
                    <div class="form-group">
                        <input type="text" class="form-input" name="username" id="PrisijungimoVardas" placeholder="Slapyvardis" value="{{ old('username') }}"/>
                        @error('username')
                            {{ 'Privaloma' }}
                            
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="Email" placeholder="El paštas" value="{{ old('email') }}"/>
                        @error('email')
                            {{ 'Privaloma' }}
                            
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="password" id="Slaptazodis" placeholder="Slaptažodis"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        @error('password')
                        {{ 'Privaloma' }}
                        
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password_confirmation" id="re_password" placeholder="Pakartokite slaptažodi"/>
                    </div>     
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Užsiregistruokite"/>
                    </div>
                </form>
                <p class="loginhere">
                    Turite paskyra? <a href="/login" class="loginhere-link">Prisijunkite</a>
                </p>
            
             </div>
          </div>
       </div>
    </div>
 </div>


@endsection