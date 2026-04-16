<?php

declare(strict_types=1);

namespace Meubleo\Support;

use Illuminate\Support\Facades\Session;

/**
 * Toast — flash notification helper (equivalent to Orchid's Toast).
 */
class Toast
{
    public function success(string $message): static
    {
        Session::flash('meubleo_toast', ['type' => 'success', 'message' => $message]);
        return $this;
    }

    public function error(string $message): static
    {
        Session::flash('meubleo_toast', ['type' => 'danger', 'message' => $message]);
        return $this;
    }

    public function warning(string $message): static
    {
        Session::flash('meubleo_toast', ['type' => 'warning', 'message' => $message]);
        return $this;
    }

    public function info(string $message): static
    {
        Session::flash('meubleo_toast', ['type' => 'info', 'message' => $message]);
        return $this;
    }
}
