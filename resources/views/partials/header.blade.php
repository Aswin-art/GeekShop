<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

  {{-- JQUERY --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>
  <nav>
    <h1><a href="/">Sweets Shop</a></h1>

    @auth
        <p id="toggle-profile">{{ Auth::user()->nama }}</p>

        <div id="cart-profile" hidden>
          <a href="{{ route('user.profile') }}" id="profile">Profile</a>
          <form action="{{ route('user.logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </div>
    @endauth
  </nav>

  <script>
    $('#toggle-profile').click(function (e) { 
      e.preventDefault();
      $('#cart-profile').css('display', 'block');
    });
  </script>
</body>