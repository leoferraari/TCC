

 
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}
 
    <div>
        Name
        <input type="text" name="nome" value="{{ old('nome') }}">
    </div>
 
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
 
    <div>
        Password
        <input type="password" name="password">
    </div>
 
    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
        <button type="submit">Register</button>
    </div>
</form>