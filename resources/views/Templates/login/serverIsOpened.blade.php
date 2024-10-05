<p>{{ __('messages.COOKIES') }}</p>

<form method="post" name="snd">
    @csrf

    <table cellpadding="1" cellspacing="1" id="login_form">
        <tbody>
        <tr class="top">
            <th>{{ __('messages.NAME') }}</th>
            <td>
                <input
                    class="text"
                    type="text"
                    name="username"
                    value="{{ old("username") }}"
                    maxlength="30"
                    autocomplete='off'
                />
            </td>
        </tr>
        <tr class="btm">
            <th>{{ __('messages.PASSWORD') }}</th>
            <td>
                <input
                    class="text"
                    type="password"
                    name="password"
                    value="{{ old("password") }}"
                    maxlength="100"
                    autocomplete='off'
                />
            </td>
        </tr>
        @error('credentials')<tr><td colspan="2" style="text-align: center"><span class="error">{{ $message }}</span></td></tr>@enderror
        </tbody>
    </table>

    <p class="btn">
        <input type="submit" value="{{ __('messages.LOGIN') }}" />
    </p>
</form>

@error('credentials')
    <p class="error_box">
	    <span class="error">{{ __('messages.PW_FORGOTTEN') }}</span><br>
        {{ __('messages.PW_REQUEST') }}<br>
	    <a href="password.php?npw={{ $message }}">{{ __('messages.PW_GENERATE') }}</a>
    </p>
@enderror
@error('activate')
    <p class="error_box">
	    <span class="error">{{ __('messages.EMAIL_NOT_VERIFIED') }}</span><br>
        {{ __('message.EMAIL_FOLLOW') }}<br>
	    <a href=\"activate.php?usr={{ $message }}">{{ __('messages.VERIFY_EMAIL') }}</a>
	</p>
@enderror
@error('vacation')
    <p class="error_box">
        <span class="error">{{ $message }}</span>
    </p>
@enderror
