<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>E-Mail bestätigen</h2>

        <div>
			Sie haben sich soeben mit dieser E-Mail-Adresse bei To-All-Nations Sponsorenlauf-App angemeldet.
			Bitte klicken Sie den folgenden Link, um die E-Mail-Adresse zu bestätigen und damit Ihren Account freizuschalten:
			<a href="{{ $link = url('register/verify', $confirmation_code).'?email='.urlencode($email) }}"> {{ $link }} </a>
		</div>

    </body>
</html>
