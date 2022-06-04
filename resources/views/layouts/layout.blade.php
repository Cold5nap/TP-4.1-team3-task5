<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>

    <link rel="stylesheet" href="{{mix('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{mix('css/nouislider.min.css')}}">


</head>
<body class="sidebar-mini" style="height: auto;">
@if (Auth::check())
    @php
    $user_auth_data = [
        'isLoggedin' => true,
        'user' =>  Auth::user()
    ];
    @endphp
@else
    @php
    $user_auth_data = [
        'isLoggedin' => false
    ];
    @endphp
@endif
<script>
    window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
</script>
<div id="layout"></div>

<script src="{{mix('js/user.js')}}"></script>

</body>
</html>
