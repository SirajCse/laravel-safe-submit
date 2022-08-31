<?php

 namespace SirajCSE\LaravelSafeSubmit;

use Illuminate\Support\Str;

class SafeSubmit
{
    protected $tokenKey = '_safe_submit_token';

    protected $intendedKey = '_safe_submit_intended';

    public function tokenKey()
    {
        return $this->tokenKey;
    }

    public function intendedKey()
    {
        return $this->intendedKey;
    }

    public function token()
    {
        return session()->get($this->tokenKey());
    }

    public function intended($intended)
    {
        session()->put($this->intendedKey(), $intended);

        return redirect($intended);
    }

    public function getIntended()
    {
        return session()->get($this->intendedKey());
    }

    public function forgetIntended()
    {
        return session()->forget($this->intendedKey());
    }

    public function regenerateToken()
    {
        session()->put($this->tokenKey(), $this->generateTokenId());
    }

    protected function generateTokenId()
    {
        return Str::random(40);
    }
}
