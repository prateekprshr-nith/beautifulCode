Click here to reset your password: <a href="{{ $link = url('/hostelStaffs/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
