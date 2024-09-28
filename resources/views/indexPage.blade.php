<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ $title }}</title>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta name="content-language" content="{{ app()->getLocale() }}"/>

    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('gpack/travian/main.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('gpack/travian/flaggs.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('gpack/travian/main_en.css') }}"/>
    <style>
        li.c4 {
            background-image: url('{{ asset('img/en/welten/en1_big.jpg') }}');
        }
        li.c3 {
            background-image: url('{{ asset('img/en/welten/en1_big_g.jpg') }}');
        }
        div.c2 {
            left: 237px;
        }

        ul.c1 {
            position: absolute;
            left: 0;
            width: 686px;
        }
    </style>

    <script src="{{ asset('mt-core.js') }}" type="text/javascript"></script>
    <script src="{{ asset('new.js') }}" type="text/javascript"></script>
    <script src="{{ asset('new2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('flaggen.js?a') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var region_list = new Array('Europe', 'America', 'Asia', 'Middle East', 'Africa', 'Oceania');
        show_flags('', '', region_list);
    </script>
    <script type="text/javascript">
        var screenshots = [
            {
                'img': 'img/en/s/s1.png',
                'hl': "{{ __('index.screenshots.title1') }}",
                'desc': "{{ __('index.screenshots.desc1') }}"
            }, {
                'img': 'img/en/s/s2.png',
                'hl': "{{ __('index.screenshots.title2') }}",
                'desc': "{{ __('index.screenshots.desc2') }}"
            }, {
                'img': 'img/en/s/s4.png',
                'hl': "{{ __('index.screenshots.title3') }}",
                'desc': "{{ __('index.screenshots.desc3') }}"
            }, {
                'img': 'img/en/s/s3.png',
                'hl': "{{ __('index.screenshots.title4') }}",
                'desc': "{{ __('index.screenshots.desc4') }}"
            }, {
                'img': 'img/en/s/s5.png',
                'hl': "{{ __('index.screenshots.title5') }}",
                'desc': "{{ __('index.screenshots.desc5') }}"
            }, {
                'img': 'img/en/s/s7.png',
                'hl': "{{ __('index.screenshots.title6') }}",
                'desc': "{{ __('index.screenshots.desc6') }}"
            }, {
                'img': 'img/en/s/s8.png',
                'hl': "{{ __('index.screenshots.title7') }}",
                'desc': "{{ __('index.screenshots.desc7') }}"
            }];
        var galarie = new Fx.Screenshots('screen_view', 'screen_hl', 'screen_desc', screenshots);
    </script>
</head>

<body class="presto indexPage">
<div class="wrapper">
    <div id="country_select">
        <div id="flags"></div>
    </div>
    <div id="header"><h1><{{ __("index.index_1") }}</h1></div>
    <div id="navigation">
        <a href="/" class="home"><img src="{{ asset('img/x.gif') }}" alt="Travian"/></a>
        <table class="menu">
            <tr>
                <td><a href="/tutorial"><span>{{ __('messages.TUTORIAL') }}</span></a></td>
                <td><a href="/anleitung"><span>{{ __("index.index_2") }}</span></a></td>
                <td><a href="?signup" class="signup_link mark"><span>{{ __("index.register") }}</span></a></td>
                <td><a href="?login" class="login_link"><span>{{ __('messages.LOGIN') }}</span></a></td>
            </tr>
        </table>
    </div>

    @if (defined('T4_COMING') && T4_COMING)
        <div id="t4play">
            <a href="{{ url('notification/') }}">
                <img src="{{ asset('img/t4n/Teaser_Prelandingpage_EN.png') }}" alt="Travian 4"/>
            </a>
        </div>
    @endif

    <div id="register_now">
        <a href="?signup" class="signup_link">{{ __("index.register") }}</a>
        <span>{{ __('messages.PLAY_NOW') }}</span>
    </div>

    <div id="content">
        <div class="grit">
            <div class="infobox">
                <div id="what_is_travian">
                    <h2>{{ __("index.index_4") }}</h2>
                    <p>{{ __("index.index_5") }}</p>
                    <p class="play_now"><a href="?signup" class="signup_link">{{ __("index.index_6") }}</a>
                    </p>
                </div>

                <div id="player_counter">
                    <table>
                        <tbody>
                        <tr>
                            <th>{{ __("index.index_7") }}:</th>
                            <td>{{ $registeredPlayers }}</td>
                        </tr>

                        <tr>
                            <th>{{ __("index.index_8") }}:</th>
                            <td>{{ $activePlayers }}</td>
                        </tr>

                        <tr>
                            <th>{{ __("index.index_9") }}:</th>
                            <td>{{ $onlinePlayers }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div id="about_the_game">
                    <h2>{{ __("index.index_10") }}:</h2>
                    <ul>
                        <li>{{ __("index.index_11") }}</li>
                        <li>{{ __("index.index_12") }}</li>
                        <li>{{ __("index.index_13") }}</li>
                    </ul>
                </div>
            </div>

            <div class="secondarybox">
                <div id="screenshots">
                    <h2>{{ __('messages.SCREENSHOTS') }}</h2>
                    <a href="#last" class="navi prev dynamic_btn"><img class="dynamic_btn" src="{{ asset('img/x.gif') }}" alt="previous"/></a>
                    <div id="screenshots_preview">
                        <ul id="screenshot_list" class="c1">
                            <li><a href="#"><img src="{{ asset('img/un/s/s1s.jpg') }}" alt="Screenshot"/></a></li>
                            <li><a href="#"><img src="{{ asset('img/un/s/s2s.jpg') }}" alt="Screenshot"/></a></li>
                            <li><a href="#"><img src="{{ asset('img/un/s/s4s.jpg') }}" alt="Screenshot"/></a></li>
                            <li><a href="#"><img src="{{ asset('img/un/s/s3s.jpg') }}" alt="Screenshot"/></a></li>
                            <li><a href="#"><img src="{{ asset('img/un/s/s5s.jpg') }}" alt="Screenshot"/></a></li>
                            <li><a href="#"><img src="{{ asset('img/un/s/s7s.jpg') }}" alt="Screenshot"/></a></li>
                            <li><a href="#"><img src="{{ asset('img/un/s/s8s.jpg') }}" alt="Screenshot"/></a></li>
                        </ul>
                    </div>
                    <a href="#next" class="navi next"><img class="dynamic_btn" src="{{ asset('img/x.gif') }}" alt="next"/></a>
                </div>

                <div id="newsbox">
                    <h2>{{ __('messages.NEWS') }}</h2>
                    <div class="news">@include('Templates.indexnews')</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div id="footer">
        <div class="container">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" class="logo"><img
                    alt="Licencia Creative Commons" style="border-width:0; height:31px; width:88px;"
                    src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" class="logo_traviangames"/></a>
            <ul class="menu">
                <li><a href="anleitung.php?s=3">FAQ</a>|</li>
                <li><a href="index.php?screenshots">{{ __('messages.SCREENSHOTS') }}</a>|</li>
                <li><a href="spielregeln.php">{{ __('messages.GAME_RULES') }}</a>|</li>
                <li><a href="agb.php">AGB</a>|</li>
                <li><a href="impressum.php">{{ __('messages.IMPRINT') }}</a></li>
                <li class="copyright">&copy; 2011-2014 - {{ env('SERVER_NAME') }} - All rights reserved</li>
            </ul>
        </div>
    </div>
</div>

<div id="login_layer" class="overlay">
    <div class="mask closer"></div>
    <div id="login_list" class="overlay_content">
        <h2>{{ __('messages.CHOOSE') }}</h2>
        <a href="#" class="closer"><img class="dynamic_img" alt="Close" src="{{ asset('img/un/x.gif') }}"/></a>
        <ul class="world_list">
            <li class="w_big c3" style="background-image:url('{{ assert('img/en/welten/en1_big.jpg') }}');">
                <a href="{{ route('login') }}"><img class="w_button" src="{{ asset('img/un/x.gif') }}" alt="World" title="{{ $registeredPlayers }}&nbsp;{{ __('messages.PLAYERS') }}&nbsp;|&nbsp;{{ $activePlayers }}&nbsp;{{ __('messages.ACTIVE') }}&nbsp;|&nbsp;{{ $onlinePlayers }}&nbsp;{{ __('messages.ONLINE') }}"/></a>
                <div class="label_players c0">{{ __('messages.PLAYERS') }}:</div>
                <div class="label_online c0">{{ __('messages.ONLINE') }}:</div>
                <div class="players c1">{{ $registeredPlayers }}</div>
                <div class="online c1">{{ $onlinePlayers }}</div>
            </li>
        </ul>
        <div class="footer"></div>
    </div>
</div>

<div id="signup_layer" class="overlay">
    <div class="mask closer"></div>
    <div id="signup_list" class="overlay_content">
        <h2>{{ __('messages.CHOOSE') }}</h2>
        <a href="#" class="closer"><img class="dynamic_img" alt="Close" src="{{ asset('img/un/x.gif') }}"/></a>
        <ul class="world_list">
            <li class="w_big c4" style="background-image:url('{{ assert('img/en/welten/en1_big.jpg') }}');">
                <a href="registration.php"><img class="w_button" src="{{ asset('img/un/x.gif') }}" alt="World" title="{{ $registeredPlayers }}&nbsp;{{ __('messages.PLAYERS') }}&nbsp;|&nbsp;{{ $activePlayers }}&nbsp;{{ __('messages.ACTIVE') }}&nbsp;|&nbsp;{{ $onlinePlayers }}&nbsp;{{ __('messages.ONLINE') }}"/></a>
                <div class="label_players c0">{{ __('messages.PLAYERS') }}:</div>
                <div class="label_online c0">{{ __('messages.ONLINE') }}:</div>
                <div class="players c1">{{ $registeredPlayers }}</div>
                <div class="online c1">{{ $onlinePlayers }}</div>
            </li>
        </ul>
        <div class="footer"></div>
    </div>
</div>

<div id="iframe_layer" class="overlay">
    <div class="mask closer"></div>
    <div class="overlay_content">
        <a href="#" class="closer"><img class="dynamic_img" alt="Close" src="{{ asset('img/un/x.gif') }}"/></a>
        <h2>{{ __("index.index_2") }}</h2>
        <div id="frame_box"></div>
        <div class="footer"></div>
    </div>
</div>

<div id="screenshot_layer" class="overlay">
    <div class="mask closer"></div>
    <div class="overlay_content">
        <h3>{{ __('messages.SCREENSHOTS') }}</h3>
        <a href="#" class="closer"><img class="dynamic_img" alt="Close" src="{{ asset('img/x.gif') }}"/></a>
        <div class="screenshot_view">
            <h4 id="screen_hl"></h4>
            <img id="screen_view" src="{{ asset('img/x.gif') }}" alt="Screenshot" name="screen_view"/>
            <div id="screen_desc"></div>
        </div>
        <a href="#prev" class="navi prev" onclick="galarie.showPrev();"><img class="dynamic_img" src="{{ asset('img/x.gif') }}" alt="previous"/></a>
        <a href="#next" class="navi next" onclick="galarie.showNext();"><img class="dynamic_img" src="{{ asset('img/x.gif') }}" alt="next"/></a>
        <div class="footer"></div>
    </div>
</div>

</body>
</html>
