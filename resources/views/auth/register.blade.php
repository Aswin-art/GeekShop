@include('partials.header')

<form action="{{ route('user.register') }}" method="post">
    @csrf
    <input type="text" name="nama" id="nama" required  placeholder="nama" value="{{ old('nama') }}">
    <input type="email" name="email" id="email" required  placeholder="email" value="{{ old('email') }}">
    <input type="password" name="password" id="password" required  placeholder="password">

    <button type="submit">Register</button>
</form>

@include('partials.footer')