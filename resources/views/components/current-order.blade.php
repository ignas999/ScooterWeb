@props(['currentOrder'])

<div class="loginform">
    <div class="box_text5">
          
          <div class="profilio">
            
           
            
            @if($currentOrder['status'] == 'current')
            <h1 class="bold">Aktyvus užsakymas</h1>
            <p>{{ "Užsakymo Kaina: " . $currentOrder->amount }}</p>
            <p>{{ "Modelis: ". $currentOrder->transport->name }}</p>
            <p>{{ "Pradžia: " . $currentOrder->start_date}}</p>
            <p>{{ "Pabaiga: " . $currentOrder->end_date}}</p>
            <p>{{ "Liko Laiko: ". $currentOrder->Timeleft }}
                
            @elseif($currentOrder['status'] == 'upcoming')
            <h1 class="bold">Busimas užsakymas</h1>
            <p>{{ "Užsakymo Kaina: " . $currentOrder->amount }}</p>
            <p>{{ "Modelis: ". $currentOrder->transport->name }}</p>
            <p>{{ "Pradžia: " . $currentOrder->start_date}}</p>
            <p>{{ "Pabaiga: " . $currentOrder->end_date}}</p>
            
            @else
                  <p>Užsakymo nėra</p>
            @endif
         
          </div>

          
         
          </div>
      </div>
  </div>
</div>