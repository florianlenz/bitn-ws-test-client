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

                <h2 class="page-header text-center">Chat</h2>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    Don't send private information. This is a test and not secure
                </div>
            </div>
        </div>

        <chat pub-key="{{$person->public_key}}" priv-key="{{$person->private_key}}" pseudo="{{$person->pseudo}}"></chat>

    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
