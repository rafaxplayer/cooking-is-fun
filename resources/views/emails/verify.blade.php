<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{trans('textsapp.email.verify.title',['name'=>$user->name])}}</h2>

        <div>
            {{trans('textsapp.email.verify.comment')}}
            <br/>
            <br/>
            <a href="{{url('/auth/register/verify/'.$code)}}"/>Confirm Account</a>

        </div>

    </body>
</html>