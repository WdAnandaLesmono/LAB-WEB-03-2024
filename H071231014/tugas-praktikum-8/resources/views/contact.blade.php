@extends('layouts.master')

@section('title', 'Hubungi Kami')

@section('content')
    <x-message-box 
        title="💌 Mari Terhubung!"
        message="Kami senang mendengar dari Anda! Hubungi kami melalui salah satu saluran berikut."
    />
    <div style="margin-top: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
        <div style="padding: 1.5rem; background-color: var(--light-pink); border-radius: 10px;">
            <h3 style="color: var(--dark-pink); margin-top: 0;">Informasi Kontak</h3>
            <p>📧 Email: halo@alyapink.com</p>
            <p>📱 Telepon: +822110011</p>
            <p>📍 Alamat: Jl.Perintis</p>
        </div>
@endsection