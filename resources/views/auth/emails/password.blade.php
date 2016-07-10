<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>E-Mail bestätigen</h2>

        <div>
			Du hast dein Passwort vergessen?
			Macht nichts! Folge einfach dem Folgenden Link, um ein neues Passwort zu vergeben:
			<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
		</div>

    </body>
</html>
