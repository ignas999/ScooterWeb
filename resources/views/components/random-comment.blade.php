@props(['rating'])

<div class="test_box">
    <i><img src="images/cos.png" alt="#"/></i>
    <h4>{{ $rating->user->username }}</h4>
    <p> {{ $rating->comment }}</p>
 </div>