<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>test</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <div id="app">
            <example-component></example-component>
        </div>
    </body>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</html>