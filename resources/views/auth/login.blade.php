@include('partials.header')

<form action="{{ route('user.login') }}" method="post">
    @csrf
    <input type="email" name="email" id="email" required placeholder="email" value="{{ old('email') }}">
    <input type="password" name="password" id="password" required placeholder="password">

    <button type="submit">Login</button>
</form>

@include('partials.footer')