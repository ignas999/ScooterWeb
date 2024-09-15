@props(['userinfo']) 

    
        <div class="profileform">
              <div class="profilebox">
                <img src="{{ asset('images/profile.png') }}" style="width: 100px;">
                    <h1 class="bold">Profilio informacija</h1>
                    <div class="profilio">
                    <h1>Profilio vardas: {{ auth()->user()->username }}</h1>

                    <h2>Turimas Balansas: {{ auth()->user()->balance }} Eur. <a class="deleterating" href="/userbalance">Istorija</a> </h2>
                    
                    </div>

                    
                    <H2 class="bold">Galimi veiksmai:</H2>
                    <div class="fontsize15em otherprofilio">
                    <a href="/profileinfo" >Atnaujinti Profilio Informacija</a>
                    <a href="/orderhistory">Užsakymų Istorija</a>
                    </div>
                </div>
            </div>
        </div>
   
