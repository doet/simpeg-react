<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="http://localhost:6001/socket.io/socket.io.js"></script>

</head>
<body>
    <div id="app">
        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple message.</p>
            <hr class="my-4">
        </div>
    </div>
    <div id="message"></div>
    <script src="{{ asset('/js/app.js')}}"></script>
</body>
</html>
