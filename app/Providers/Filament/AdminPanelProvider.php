<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\LoginCustom;
use App\Filament\Widgets\AllStatsWidget;
use Carbon\Carbon;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Niladam\FilamentAutoLogout\AutoLogoutPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->renderHook(
                'panels::head.start',
                fn() => '<link rel="icon" href="/img/Logo-fix.png">'
            )
            ->id('admin')
            ->path('admin')
            ->login(LoginCustom::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                AllStatsWidget::class,

            ])
            ->spa()
            ->font('poppin')
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('18rem')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Kelola Beranda'),
                NavigationGroup::make()
                    ->label('Kelola Infografis'),
                NavigationGroup::make()
                    ->label('Kelola Konten'),
            ])

            ->authMiddleware([
                Authenticate::class,

            ])
            ->plugins([
                AutoLogoutPlugin::make()
                    ->color(Color::Emerald)
                    ->logoutAfter(Carbon::SECONDS_PER_MINUTE * 5),

            ]);
    }
}
