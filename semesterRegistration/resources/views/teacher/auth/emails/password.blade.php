Click here to reset your password: <a href="{{ $link = url('/teachers/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
