<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your account {{$user->name}}</h2>

        <div>
            Thanks for signing up for Cooking-is-Fun, access the following link to verify your account and then log in with your credentials. a greeting.
            <br/>
            <a href="{{url('/auth/register/verify/'.$code)}}"/>Confirm Account</a>

        </div>

    </body>
</html>