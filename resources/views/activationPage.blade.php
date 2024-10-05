<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link REL="shortcut icon" HREF="../favicon.ico"/>
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
</head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
    <div id="dynamic_header"></div>
    <div id="header"></div>
    <div id="mid">
        <div id="content" class="activate">
            @switch($error)
                @case(1)
                    @include('Templates.activation.delete')
                    @break
                @case('activated')
                    @include('Templates.activation.activated')
                    @break
                @case('not_found')
                    @include('Templates.activation.cantfind')
                    @break
                @default
                    @if ($isOpen)
                        <div id="content" class="signup">
                            @include('Templates.activation.activationForm')
                        </div>
                    @else
                        @include('Templates.activation.activationCountdown')
                    @endif
            @endswitch
        </div>
        <div id="side_info" class="outgame">
        </div>

        <div class="clear"></div>
    </div>

    <div class="footer-stopper outgame"></div>
    <div class="clear"></div>

    @include('Templates.footer')
    <div id="ce"></div>
</body>
</html>
