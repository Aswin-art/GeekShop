@include('partials.header')

<header>
  <div class="smoothie">
    <img src="{{ asset('images/smoothie.png') }}" alt="">
  </div>
  <div class="headings">
    <h2>My Online Shop</h2>
    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur maiores veritatis, omnis eum ab et.</h3>
    <a href="{{ route('shop') }}" class="btn">Browse Now</a>
  </div>
</header>


@include('partials.footer')