<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="email" style="margin: 20px auto; width: 90%; font-family: Verdana, sans-serif;">
			<h2 style="background-color: #16ABCC; color: #fff; padding: 12px; border-bottom: 3px solid #1491ad; margin-bottom: 20px;">@lang('connect.email.password.reset')</h2>

			<p style="display: block; margin-top: 40px; !important">@lang('connect.email.password.reset.text')</p>
			<p style="display: block; margin-top: 40px; !important">@lang('connect.email.password.expire.text') {{ Config::get('auth.reminder.expire', 60) }} @lang('connect.email.password.expire.minutes') </p>
			<a href="{{ URL::to('password/reset', array($token)) }}" style="display: inline-block; margin-top: 20px; background-color: #D0513F; padding: 8px 16px; color: #fff; text-decoration: none; border-radius: 4px; border-bottom: 3px solid #973d30;">@lang('connect.email.password.reset')</a>
		</div>

	</body>
</html>

