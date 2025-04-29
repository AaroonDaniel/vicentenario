<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class CustomVerifyEmailController extends \App\Http\Controllers\Controller
{
    /**
     * Verifica el correo electrónico del usuario.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Si ya está verificado, lo llevamos a index
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        // Si no está verificado y hacemos clic en el link, lo verificamos
        $request->fulfill();

        // Redirigimos a la página principal después de verificar
        return redirect()->intended('/');
    }
}