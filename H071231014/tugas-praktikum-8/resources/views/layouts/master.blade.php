<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dunia Pink</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-pink: #FF69B4;
            --secondary-pink: #FFB6C1;
            --light-pink: #FFF0F5;
            --dark-pink: #DB7093;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: var(--light-pink);
            color: #333;
        }

        .navbar {
            background-color: var(--primary-pink);
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .footer {
            background-color: var(--primary-pink);
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
        }

        .content {
            margin-bottom: 100px;
            background-color: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        h1 {
            color: var(--dark-pink);
            border-bottom: 2px solid var(--secondary-pink);
            padding-bottom: 0.5rem;
            justify-content: center;
            align-items: center;
            
        }

        .nav-button {
            transition: all 0.3s ease;
        }

        .nav-button:hover {
            background-color: var(--dark-pink) !important;
            transform: translateY(-2px);
        }

        .message-box {
            border-left: 4px solid var(--primary-pink);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <x-nav-button href="{{ route('home') }}" text="Home" />
        <x-nav-button href="{{ route('about') }}" text="About" />
        <x-nav-button href="{{ route('contact') }}" text="Contact" />
    </nav>

    <div class="container">
        <div class="content">
            <h1>@yield('title')</h1>
            @yield('content')
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Dunia Pink.</p>
    </footer>
</body>
</html>