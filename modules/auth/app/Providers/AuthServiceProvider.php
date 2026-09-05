<?php

namespace Modules\Auth\Providers;

use Illuminate\Auth\RequestGuard;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Notifications\Messages\MailMessage;
use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportUserProvider;
use League\OAuth2\Server\ResourceServer;
use Modules\Auth\Guards\APIKeyOrPassportGuard;

class AuthServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Auth';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'auth';

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public function boot(): void
    {
        parent::boot();

        $this->registerVerifyEmail();

        Auth::extend('api_key_or_passport', function ($app, $name, array $config) {
            $guard = new RequestGuard(
                new APIKeyOrPassportGuard(
                    $app->make(ResourceServer::class),
                    new PassportUserProvider(
                        Auth::createUserProvider($config['provider'] ?? null),
                        $config['provider'] ?? 'users'
                    ),
                    $app->make(ClientRepository::class),
                    $app->make(Encrypter::class)
                ),
                $app['request']
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }

    protected function registerConfig(): void
    {
        // auth config exists in the main config folder, so we don't need to publish it here.
    }

    protected function registerVerifyEmail(): void
    {
        VerifyEmail::createUrlUsing(static function (object $notifiable): string {
            $frontendUrl = config('app.frontend_url', 'http://localhost:5173');
            $id = $notifiable->getKey();
            $hash = sha1($notifiable->getEmailForVerification());

            return $frontendUrl.'/auth/verify-email/'.$id.'/'.$hash;
        });

        VerifyEmail::toMailUsing(static function (object $notifiable, string $url): MailMessage {
            return (new MailMessage)
                ->subject(__('auth.verify_email.subject'))
                ->line(__('auth.verify_email.line_1'))
                ->action(__('auth.verify_email.action'), $url)
                ->line(__('auth.verify_email.line_2'));
        });
    }
}
