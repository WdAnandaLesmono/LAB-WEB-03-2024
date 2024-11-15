<!-- resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - ReynaldyAl Portfolio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('style/portofolio.css') }}" rel="stylesheet">
  
</head>
<body>

  <!-- Particles Background -->
  <div id="particles-js"></div>

  <!-- Navbar -->
  @include('components.navbar')

  <main>
    @yield('content')
  </main>

  <!-- Social Icons Section -->
  @yield('social-icons')

  <!-- Footer Section -->
  @yield('footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
  <script src="{{ asset('js/styling.js') }}"></script>
  
</body>
</html>