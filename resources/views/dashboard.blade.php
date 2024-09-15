@extends('components.layout')

@section('content')

<x-profile-info :userinfo="auth()->user()" />
   <div class="dashboardothers">
        <h1>Meniu</h1>
        
           <div class="containermenu">
            
              <a class="nav-link" href="/models">Visos priemonės</a>
              <a class="nav-link" href="/ratings">Mano įvertinimai</a>
              
            
              </div>
           </div>
        
   
      </div>

      

   <x-current-order :currentOrder=$currentOrder ></x-current-order>

    
@endsection