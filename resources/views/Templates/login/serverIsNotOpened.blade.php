@section ('customJs')
    <script language="JavaScript">
        TargetDate = {{ date('Y-m-d H:i:s', $startTs) }};
        CountActive = true;
        CountStepper = -1;
        LeadingZero = true;
        DisplayFormat = "%%H%%:%%M%%:%%S%%";
        FinishMessage = "START NOW";

        function calcage(secs, num1, num2) {
            s = ((Math.floor(secs / num1)) % num2).toString();
            if (LeadingZero && s.length < 2)
                s = "0" + s;
            return "" + s + "";
        }

        function CountBack(secs) {
            if (secs < 0) {
                document.getElementById("cntdwn").innerHTML = FinishMessage;
                return;
            }
            DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs, 86400, 100000));
            DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs, 3600, 100000));
            DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs, 60, 60));
            DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs, 1, 60));

            document.getElementById("cntdwn").innerHTML = DisplayStr;
            if (CountActive)
                setTimeout("CountBack(" + (secs + CountStepper) + ")", SetTimeOutPeriod);
        }

        function putspan(backcolor, forecolor) {
            document.write("<div class='activation_time' id='cntdwn'></div>");
        }

        if (typeof (BackColor) == "undefined")
            BackColor = "white";
        if (typeof (ForeColor) == "undefined")
            ForeColor = "black";
        if (typeof (TargetDate) == "undefined")
            TargetDate = "12/31/2020 5:00 AM";
        if (typeof (DisplayFormat) == "undefined")
            DisplayFormat = "%%H%%:%%M%%:%%S%%";
        if (typeof (CountActive) == "undefined")
            CountActive = true;
        if (typeof (FinishMessage) == "undefined")
            FinishMessage = "";
        if (typeof (CountStepper) != "number")
            CountStepper = -1;
        if (typeof (LeadingZero) == "undefined")
            LeadingZero = true;


        CountStepper = Math.ceil(CountStepper);
        if (CountStepper == 0)
            CountActive = false;
        var SetTimeOutPeriod = (Math.abs(CountStepper) - 1) * 1000 + 990;
        putspan(BackColor, ForeColor);
        var dthen = new Date(TargetDate);
        var dnow = new Date();
        if (CountStepper > 0)
            ddiff = new Date(dnow - dthen);
        else
            ddiff = new Date(dthen - dnow);
        gsecs = Math.floor(ddiff.valueOf() / 1000);
        CountBack(gsecs);

</script>
@endsection

<p><font color="red" size="6">{{ __('messages.NOT_OPENED_YET') }}</font></p>

<h5><img class="img_u04" src="img/x.gif" alt="login"/></h5>
<p>{{ __('messages.COOKIES') }}</p>

<br/>
<center><big>Server will start in: </big></center>
