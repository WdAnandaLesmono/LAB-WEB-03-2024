<!-- resources/views/contact.blade.php -->
@extends('layouts.master')

@section('title', 'Contact')

@section('content')
<section class="contact-form container my-5 py-5">
  <h3 class="text-center mb-4">Get In Touch</h3>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" id="message" rows="5" placeholder="Your message"></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-gold">Send Message</button>
        </div>
      </form>
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
      <a href="#privacy-policy">Privacy Policy</a> 
      <a href="#terms-of-service">Terms of Service</a>
    </p>
    <p class="text-center">Universitas Hasanuddin | Sistem Informasi 23</p>
  </div>
</footer>
@endsection