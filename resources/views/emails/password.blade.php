<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{trans('textsapp.email.reset.title')}}</h2>
        <div>
            {{trans('textsapp.email.reset.comment')}}
            <br/>
            <br/>
            {{url('auth/password/reset/'.$token)}}

        </div>

    </body>
</html>