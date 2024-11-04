@extends('base')

@section('title', 'Home')

@section('content')
<section class="hero">
    <div class="container-fluid">
      <div class="top2">
        <p class="pesatu">Hello!</p>
        <p style="font-size: 20px; margin-top: -30px;"> Let's Explore Our Home</p>
        <hr style="width: 10%; text-align: center; border: 2px solid #ffe100; margin: auto; background-color: yellow;">
      </div>
    </div>

  </section>

  <div class="container-fluid" id="home">
    <div class="item">
      <img class="img-fluid" src="img/mnt3.jpg" alt="">
      <div class="layer"></div>
      <div class="info">
        <h1>Travel EveryWhere</h1>
        <p>
        Top 10 Most Recommended Place to Go
        </p>
        <button><a href="https://www.idntimes.com/travel/destination/dhiya-azzahra/wisata-terbaik-2024-versi-national-geographic" target="_blank">More Info</a></button>
      </div>
    </div>
  </div>
@endsection