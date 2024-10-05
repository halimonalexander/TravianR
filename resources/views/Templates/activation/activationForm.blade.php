<h1><img src="{{ asset('/img/x.gif') }}" class="anmelden" alt="register for the game"></h1>
<h5><img src="{{ asset('/img/x.gif') }}" class="img_u05" alt="registration"/></h5>
<p>
    Hello {{ $user->username }},
    <br/>
    <br/>
    The registration was successful. In the next few minutes you will receive an email with the access information.
    <br/><br/>
    The email will be sent to following address: <span class="important">{{ $user->email }}</span>
</p>
<p>In order to activate your account enter the code or click on the link in your email.</p>
<div id="activation">
    <form method="post">
        @csrf
        <p class="important">Activation code:</p>
        <input type="hidden" name="uid" value="{{ $uid }}">
        <input type="hidden" name="act" value="{{ $act }}">
        <input class="text" type="text" name="code" maxlength="10"/>
        @if ($error === 'code_missmatch')
        <ul class="important">{{ __('messages.incorrect_code') }}</ul>
        @endif

        <p>
            <input type="image" src="{{ asset('/img/x.gif') }}" id="btn_send" class="dynamic_img" alt="send"/>
        </p>
    </form>
</div>
<div id="no_mail">
    <p>
        <span class="important">No email received?</span>
    </p>
    <p>
        Sometimes the email is moved to the spam folder. Please try again later</a>
    </p>
</div>
