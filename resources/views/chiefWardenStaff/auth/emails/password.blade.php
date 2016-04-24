Click here to reset your password: <a href="{{ $link = url('/chiefWardenStaffs/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
