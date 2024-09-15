
@props(['transports'])

<div class="row">
    <div class="col-md-12">
        <div class="our_products">
            <div class="row">
                @unless (count($transports) == 0)
                    
               
                @foreach ($transports as $transport)
                <div class="col-md-4 margin_bottom1">
                    <div class="product_box">
                        @if($transport['image'] == "")
                        <figure><img src="{{asset('images/loading.jpg')}}" style="height: 9vw;"></figure>
                        @else
                        <figure><img src="{{asset('images/transports/'. $transport['image'])}}" style="height: 9vw;"></figure>

                        @endif
                    
                    <h3>{{ $transport['name'] }}</h3>
                    </div>
                </div>
                @endforeach
                @else{
                    <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                        <figure><img src="{{asset('images/transports/'. $transport['image'])}}" style="height: 9vw;"></figure>
                        <h3>Šiuo metu nėra</h3>
                        </div>
                    </div>
                }
                @endunless
            </div>
        </div>
    </div>
</div>
