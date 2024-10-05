<div id="content" class="signup">
    <h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1>
    <h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>

    <p>{!! __('messages.BEFORE_REGISTER', ['link' => '<a href="../anleitung.php" target="_blank">' . __('instructions') . '</a>', 'servername' => env('SERVER_NAME')]) !!}</p>

    <form name="snd" method="post">
        @csrf
        <input type="hidden" name="invited" value="{{ old('invited', $invited) }}"/>
        <table cellpadding="1" cellspacing="1" id="sign_input">
            <tbody>
            <tr class="top">
                <th>{{ __('messages.NICKNAME') }}</th>
                <td>
                    <input class="text" type="text" name="username" value="{{ old('username') }}" maxlength="30"/>
                    @error('username')<span class="error">{{ $message }}</span>@enderror
                </td>
            </tr>
            <tr>
                <th>{{__('messages.EMAIL') }}</th>
                <td>
                    <input class="text" type="email" name="email" value="{{ old('email') }}"/>
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </td>
            </tr>
            <tr>
                <th>{{__('messages.PASSWORD') }}</th>
                <td>
                    <input class="text" type="password" name="password" value="{{ old('password') }}" maxlength="100"/>
                    @error('password')<span class="error">{{ $message }}</span>@enderror
                </td>
            </tr>
            </tbody>
        </table>

        <table cellpadding="1" cellspacing="1" id="sign_select">
            <tbody>
            <tr class="top">
                <th><img src="img/x.gif" class="img_u06" alt="choose tribe"></th>
                <th colspan="2"><img src="img/x.gif" class="img_u07" alt="starting position"></th>
            </tr>
            <tr>
                <td class="nat">
                    <label>
                        <input class="radio" type="radio" name="tribe" value="1" {{ old('tribe') == 1 ? 'checked' : '' }}>
                        {{ __('messages.ROMANS') }}
                    </label>
                </td>
                &nbsp;
                <td class="pos1">
                    <label>
                        <input class="radio" type="radio" name="location" value="0" checked>&nbsp;{{ __('messages.RANDOM') }}
                    </label>
                </td>
                <td class="pos2">&nbsp;</td>
            </tr>

            <tr>
                <td>
                    <label>
                        <input class="radio" type="radio" name="tribe" value="2" {{ old('tribe') == 2 ? 'checked' : '' }}>
                        {{ __('messages.TEUTONS') }}
                    </label>
                </td>
                <td>
                    <label>
                        <input class="radio" type="radio" name="location" value="1" {{ old('location') == 1 ? 'checked' : '' }}>
                        {{ __('messages.NW') }}
                        <b>(-|+)</b>
                    </label>
                </td>
                <td>
                    <label>
                        <input class="radio" type="radio" name="location" value="2" {{ old('location') == 2 ? 'checked' : '' }}>
                        {{ __('messages.NE') }}
                        <b>(+|+)</b>
                    </label>
                </td>
            </tr>

            <tr class="btm">
                <td>
                    <label>
                        <input class="radio" type="radio" name="tribe" value="3" {{ old('tribe') == 3 ? 'checked' : '' }}>
                        {{ __('messages.GAULS') }}
                    </label>
                </td>
                <td>
                    <label>
                        <input class="radio" type="radio" name="location" value="3" {{ old('location') == 3 ? 'checked' : '' }}>
                        {{ __('messages.SW') }}
                        <b>(-|-)</b>
                    </label>
                </td>
                <td>
                    <label>
                        <input class="radio" type="radio" name="location" value="4" {{ old('location') == 4 ? 'checked' : '' }}>
                        {{ __('messages.SE') }}
                        <b>(+|-)</b>
                    </label>
                </td>
            </tr>
            </tbody>
        </table>

        <ul class="important">
            @error('error'){{ $message }}@enderror
            @error('tribe'){{ $message }}@enderror
            @error('agreement'){{ $message }}@enderror
        </ul>

        <p>
            <label>
                <input class="check" type="checkbox" name="agreement" value="1" {{ old('agreement') == 1 ? 'checked' : '' }}/>
                {{ __('messages.ACCEPT_RULES') }}
            </label>
        </p>

        <p class="btn">
            <input type="image" value="anmelden" name="s1" id="btn_signup" class="dynamic_img" src="img/x.gif" alt="register"/>
        </p>
    </form>

    <p class="info">{{ __('messages.ONE_PER_SERVER') }}</p>
</div>
