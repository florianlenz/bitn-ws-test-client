<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

<div id="app">

        <div class="container">

            <div class="row">

                <div class="col-sm-12">

                    <h2 class="page-header text-center">Create new ident</h2>

                    @if($errors->has('pseudo'))
                        <div class="alert alert-danger">
                            {{$errors->get('pseudo')[0]}}
                        </div>
                    @endif

                    @if($errors->has('description'))
                        <div class="alert alert-danger">
                            {{$errors->get('description')[0]}}
                        </div>
                    @endif

                    <form method="post" action="/profile/new">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input id="pseudo"  type="text" class="form-control" name="pseudo" value="{{old('pseudo')}}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input id="description" type="text" class="form-control" name="description" value="{{old('description')}}">
                        </div>

                        <button class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>

            <hr>

            <div class="row">

                <div class="col-sm-12">

                    <h2 class="page-header text-center">profiles</h2>

                    <ul>
                        @foreach($profiles as $profile)
                            <div class="alert alert-info">
                                Pseudo: <b>{{$profile->pseudo}}</b> <br>
                                Description: <b>{{$profile->description}}</b> <br>
                                PrivateKey: <b>{{$profile->private_key}}</b> <br>
                                PublicKey: <b>{{$profile->public_key}}</b> <br>
                            </div>
                            <a href="/chat/{{$profile->id}}">USE PROFILE</a>
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
