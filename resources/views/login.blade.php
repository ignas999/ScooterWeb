@extends('components.layout')


@section('content')
<div class="three_box">
    <div class="container margincontent">
       <div class="loginform">
             <div class="box_text">
               
                <form method="POST" id="signup-form" class="signup-form" action="/login">
                    @csrf
                    <h2 class="form-title">Prisijunkite</h2>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="El paštas"/>
                        @error('email')
                            {{ 'Privaloma' }}
                            
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password" placeholder="Slaptažodis"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        @error('password')
                            {{ 'Privaloma' }}
                            
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Prisijungti"/>
                    </div>
                </form>
                <p class="loginhere">
                    Neturite paskyros? <a href="/register" class="loginhere-link">Užsiregistruokite čia</a>
                </p>
            
             </div>
          </div>
       </div>
    </div>
 </div>


@endsection