<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your account {{$user->name}}</h2>

        <div>
            Thanks for creating an account with the verification demo app.
            Please follow the link below to verify your email address
            {{ URL::to('auth/register/verify/'.$code)}}

        </div>

    </body>
</html>