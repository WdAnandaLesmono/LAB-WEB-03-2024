<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Pertemuan-8 | @yield('title')</title>

</head>
<body>
    <a href="{{route('home')}}">Home</a>    
    <a href="{{route('about')}}">About</a> 
    <a href="{{route('contact')}}">Contact</a> 
    @include('components.navbar')
    
    <div class="">
      @yield('content')
    </div>
    
      <footer>
        <div class="logo">
          <img src="img/National Geographic Logo and symbol, meaning, history, PNG, brand.jpeg" alt="">
        </div>
        <div class="copyright">
          <p>
            Copyright © 1996-2015 National Geographic Society
          </p>
          <p>
            Copyright © 1996-2015 National Geographic Society
          </p>
        </div>
      </footer>
    
    
    
    
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

     




    

</body>
</html>

