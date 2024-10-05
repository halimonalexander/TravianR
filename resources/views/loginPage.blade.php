<!DOCTYPE html>
<html>
<head>
    {{--    <title>{{ $title }}</title>--}}
    <link REL="shortcut icon" HREF="favicon.ico"/>
    <meta name="content-language" content="en"/>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <link href="{{ asset($gpack . 'lang/en/compact.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset($gpack . 'lang/en/lang.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset($gpack . 'travian.css') }}" rel="stylesheet" type="text/css"/>

    <script src="{{ asset('js/mt-core.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/mt-more.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/unx.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/new.js') }}" type="text/javascript"></script>
    @yield('customJs')
</head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
    <div id="dynamic_header"></div>
    <div id="header">
{{--        <ul>--}}
{{--            <li><a href="{{ route('indexPage') }}">{{ __('messages.HOME') }}</a></li>--}}
{{--            <li><a href="{{ route('registrationPage') }}">{{ __('index.register') }}</a></li>--}}
{{--        </ul>--}}
    </div>
    <div id="mid">
        {{--        @include('Templates.menu')--}}

        <div id="content" class="login">
            <h1><img class="img_login" src="img/x.gif" alt="log in the game"/></h1>

            @if (!$isOpen)
                @include('Templates.login.serverIsNotOpened')
            @else
                @include('Templates.login.serverIsOpened')
            @endif
        </div>
        <div class="clear"></div>
    </div>

    <div class="footer-stopper outgame"></div>
    <div class="clear"></div>

    @include("Templates.footer")
    <div id="ce"></div>
</body>
</html>
