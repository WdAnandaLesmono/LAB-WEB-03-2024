<!-- resources/views/about.blade.php -->
@extends('layouts.master')

@section('title', 'About')

@section('content')
<section id="about" class="about-me container my-5 py-5">
  <div class="row align-items-center">
    <div class="col-md-4 text-center">
      <img src="{{ asset('images/04-profil.png') }}" alt="Avatar" class="img-fluid profile-img-about">
    </div>
    <div class="col-md-8">
      <h2>About Me</h2>
      <p class = "about-text">
        Hi everyone! My name is Reynaldy Al. I'm a Maha-Student from Makassar, University of Hasanuddin.
        I have 1 years experience in doing something and make something worst. but somehow i make that better too!
        In my opinion, creating programs is not just a job, but also an art that has aesthetic value.
      </p>
      <p class = "about-text">
        Today's task for praktikum is build your website to be functional and user-friendly, yet still attractive.
        In addition, I provide a personal touch to your product and ensure that the website catches attention
        and is easy to use. My goal is to convey your message and identity in the most creative way possible.
      </p>
    </div>
  </div>

  <!-- <script src="{{ asset('js/styling.js') }}"></script> -->

  <div class="skills-section mt-5">
    <h3 class="text-center">Skills</h3>
    <div class="row text-center">
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">HTML</div>
      </div>
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">CSS</div>
      </div>
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">PHP</div>
      </div>
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">JavaScript</div>
      </div>
    </div>
    <div class="row text-center mt-3">
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">Rebahan</div>
      </div>
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">Love language</div>
      </div>
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">English</div>
      </div>
      <div class="col-md-3 col-6 skill-box">
        <div class="tech-stack">Bhs.Indonesia</div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('social-icons')
<div class="social-icons text-center">
  <a href="https://github.com/reynaldyAl"><i class="bi bi-github"></i></a>
  <a href="www.linkedin.com/in/reynaldy-al-495390315"><i class="bi bi-linkedin"></i></a>
  <a href="https://www.instagram.com/Reynaldy_al/"><i class="bi bi-instagram"></i></a>
</div>
@endsection

@section('footer')
<footer>
  <div class="container">
    <p class="text-center">&copy; 2024 ReynaldyAl. All rights reserved.</p>
    <p class="text-center">Contact: <a href="mailto:reynaldy.al@gmail.com">reynaldy.al@gmail.com</a></p>
    <p class="text-center">
      <a href="#privacy-policy">Privacy Policy</a> | 
      <a href="#terms-of-service">Terms of Service</a>
    </p>
    <p class="text-center">Universitas Hasanuddin | Sistem Informasi 23</p>
  </div>
</footer>
@endsection