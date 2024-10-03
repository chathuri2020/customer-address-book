<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Customer Address Book</h1>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        @endguest

        @auth
            <p>Welcome, {{ Auth::user()->name }}!</p>
            <a href="{{ route('home') }}" class="btn btn-success">Go to Dashboard</a>
            <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </div>
</body>
</html>
