@extends('base')

@section('title', 'Home')

@section('content')
<div class="container-fluid" id="about">
    <div class="main-content">
      <p style="font-size: 20px; font-weight: bold;">EXPLORE NATURE</p>
      <P style="font-size: 15px; text-align: center;">Nature is a remarkable force that encompasses the beauty and complexity of the world around us. <br>From towering mountains and vast oceans to delicate flowers and lush forests, nature offers an endless <br> source of inspiration and tranquility. Its cycles of growth, change, and renewal remind us of the <br> interconnectedness of all living things. Whether through the rustling of leaves in the wind or the gentle <br> flow of a river, nature has the power to calm and rejuvenate the soul, reminding <br>us of the harmony and balance that exists in the natural world.</P>
      <a href="#">EXPLORE NOW</a>
    </div>
  </div>

  <div id="aboutimg" class="container-fluid" style="margin-top: 100px;">
    <div class="container text-center" id="imgimg">
      <div class="top3">
        <P style="text-align: left;">DISCOVER MORE ON YOUTUBE</P>
      </div>
      <div class="row" id="gallery">
        <div class="col">
          <a href="https://www.youtube.com/@MarischkaPrudence" target="_blank"><img src="img/Marischka Prudence.jpeg" alt=""></a>
        </div>
        <div class="col">
          <a href="https://www.youtube.com/@fiersabesari" target="_blank"><img src="img/Fiersa Besari.jpeg" alt=""></a>

        </div>
        <div class="col">
          <a href="https://www.youtube.com/@lostpacker" target="_blank"><img src="img/images9.jpeg" alt=""></a>

        </div>
        <div class="col">
          <a href="https://www.youtube.com/@vagabrothers" target="_blank"><img src="img/image10.jpg" alt=""></a>

        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div id="carouselExampleCaptions" class="carousel slide mx-5 mt-5">
      <div class="top4 text-light fw-bold mb-5" style="text-align: center; margin-top: 200px; font-size: 45px; margin-bottom: 100px;">
        <a>NATURE</a>
      </div>
      <div class="carousel-indicators" style="margin-top: 200px;">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner" style="margin-top: 200px;">
        <div class="carousel-item active">
          <img src="img/krs3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Lembah Lohe</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/krs2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Rinjani Mount</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/krs1.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Everest Mount</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
@endsection