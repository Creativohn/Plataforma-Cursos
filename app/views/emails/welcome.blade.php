<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="email" style="margin: 20px auto; width: 90%; font-family: Verdana, sans-serif;">
			<h2 style="background-color: #16ABCC; color: #fff; padding: 12px; border-bottom: 3px solid #1491ad; margin-bottom: 20px;">@lang('connect.email.welcome')</h2>
			<span><strong>@lang('connect.email.hi') {{ $name }}</strong></span>

			<p style="display: block; margin-top: 40px; !important">@lang('connect.email.welcome.text')</p>
			<a href="{{ URL::to('/verify') }}/{{ $email }}/{{ $validate_code }}/" style="display: inline-block; margin-top: 20px; background-color: #D0513F; padding: 8px 16px; color: #fff; text-decoration: none; border-radius: 4px; border-bottom: 3px solid #973d30;">Validate</a>
		</div>

	</body>
</html>
