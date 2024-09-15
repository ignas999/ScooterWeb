@extends('components.layout')

@section('content')
    


<div class="box_text-2">
    <form method="POST" class="signup-form-2" action="/addrating/{{ $transport->transport_id }}">
        @csrf
        <h2 class="form-title-2">Pridėkite įvertinima</h2>
        <img src="{{asset('images/transports/'. $transport->image)}}" style="height: 9vw;">
        <div class="form-group-2">
            <label> Modelis</label>
            <select name="transport" class="form-input-2">
                <option value="{{ $transport->transport_id }}">{{ $transport->name }}</option>
            </select>
            @error('transport')
                {{ 'Privaloma' }}
            @enderror
        </div>
        <div class="form-group-2">
            <label> Įvertinimas</label>
            <select name="rating" class="form-input-2">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('comment')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group-2">
            <input type="text" class="commentsfield-2" name="comment" placeholder="Galite palikti komentara (neprivaloma)">
            @error('comment')
                {{ $message }}
            @enderror
        </div>
        <div class="form-group-2">
            <input type="submit" name="submit" id="submit" class="form-submit-2" value="Pateikti"/>
        </div>
    </form>
</div>
@endsection