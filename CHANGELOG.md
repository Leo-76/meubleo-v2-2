# Changelog

## [2.0.0] - 2024-01-01

### Added
- Orchid-inspired architecture: Screen, Field, TD, Layout, Action pattern
- `FoundationServiceProvider` chains `ConsoleServiceProvider`, `RouteServiceProvider`, `PlatformServiceProvider`
- Central `Shop` singleton (like Orchid's `Dashboard`)
- Abstract `MeubleoServiceProvider` for user-land extension (menus, routes)
- Fluent Field API: `Input`, `TextArea`, `Select`, `Password`, `Switcher`, `DateTimer`, `Picture`, `Quill`
- Fluent Action API: `Button`, `Link`, `Menu`
- Abstract `Table` and `Rows` layouts with `TD` column builder
- Artisan commands: `meubleo:install`, `meubleo:admin`, `meubleo:screen`, `meubleo:table`, `meubleo:rows`, `meubleo:filter`, `meubleo:publish`
- Publishable stubs to `app/Meubleo/`
- `meubleo_price()`, `toast()`, `meubleo_prefix()` global helpers
- `MeubleoCart` and `MeubleoShop` facades
- All tables prefixed with `meubleo_` (no conflicts with host app)
- Multi-namespace PSR-4 autoload (`Meubleo\Screen`, `Meubleo\Platform`, `Meubleo\Filters`…)
- Full shop front-end: home, catalogue, product detail, cart, Stripe checkout, orders
- Admin panel: Dashboard, ProductListScreen, ProductEditScreen
- `Toast` flash notification helper
- JSON i18n files skeleton
- GitHub Actions CI workflow
