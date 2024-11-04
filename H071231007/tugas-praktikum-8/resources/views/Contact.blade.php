@extends('base')

@section('title', 'Contact')

@section('content')
<div id="signin" class="container-fluid" style="background-image: url('HTML/Praktikum 3/img/forest1.jpg');">
    <div class="teks1">
      <h1>THE BEST PHOTOS AND KNOWLEDGE ABOUT OUR HOME</h1>
      <P>Sign up for more inspiring photos, stories, and special offers from National Geographic.</P>
    </div>
        <!-- Button trigger modal -->
    <button type="button" id="bottun" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
      SIGN UP
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="registrationForm">
              <div class="container">
                  <label class="toggleswitch">
                      <input type="checkbox" id="toggle">
                      <span class="konten"></span>
                  </label>
              </div>
      
              <div class="input-box">
                  <label>Nama Lengkap:</label><br>
                  <input type="text" id="nama" placeholder="Masukkan nama anda" required>
                  <i class='bx bx-user' id="icon-user"></i>
              </div>
      
              <div class="input-box">
                  <label>Email:</label><br>
                  <input type="email" id="email" placeholder="Masukkan e-mail anda" required>
                  <i class='bx bx-envelope' id="icon-email"></i>
              </div>
      
              <div class="input-box">
                  <label>Tanggal Lahir:</label><br>
                  <input type="date" id="tanggalLahir" required>
              </div>
      
              <div class="input-gender">
                  <label>Jenis Kelamin:</label><br>
                  <input type="radio" name="gender" value="Laki-Laki" id="genderLaki"><label for="Laki-Laki">Laki-Laki</label><br>
                  <input type="radio" name="gender" value="Perempuan" id="genderPerempuan"><label for="Perempuan">Perempuan</label>
              </div>
              
              <div class="term-condi">
                  <input type="checkbox" name="chek" value="terms"><label for="terms">Saya menyetujui syarat dan ketentuan</label>
              </div>
  
              <button type="submit" class="btn">Daftar</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection