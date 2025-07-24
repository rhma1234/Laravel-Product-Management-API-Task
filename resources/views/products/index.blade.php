<h1>  you are logged in </h1>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">تسجيل الخروج</button>
</form>
