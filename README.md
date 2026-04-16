# 🛋️ Meubleo Shop v2

[![Latest Version on Packagist](https://img.shields.io/packagist/v/meubleo/shop.svg?style=flat-square)](https://packagist.org/packages/meubleo/shop)
[![PHP](https://img.shields.io/packagist/php-v/meubleo/shop.svg?style=flat-square)](https://packagist.org/packages/meubleo/shop)
[![License](https://img.shields.io/github/license/meubleo/shop.svg?style=flat-square)](LICENSE)

E-commerce platform for furniture shops built on top of Laravel.  
**Architecture inspired by [Orchid Platform](https://orchid.software)** — Screen-based admin panel, fluent Field/TD API, publishable stubs.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🖥️ **Screen-based admin** | Each admin page is a `Screen` class with `query()`, `commandBar()`, `layout()` |
| 🧩 **Fluent Field API** | `Input::make('name')->title('Name')->required()->placeholder('...')` |
| 📋 **Table/Rows Layouts** | `TD::make('price')->sort()->alignRight()->render(fn($p) => ...)` |
| 🛒 **Full e-commerce** | Catalogue, cart, Stripe checkout, order management |
| 🎛️ **Multi-ServiceProvider** | `FoundationServiceProvider` → chains console, routes, platform providers |
| 🔧 **Artisan commands** | `meubleo:install`, `meubleo:admin`, `meubleo:screen`, `meubleo:table`, `meubleo:rows`, `meubleo:filter` |
| 📦 **Publishable stubs** | Screens, Layouts, Filters published to `app/Meubleo/` |
| 🌍 **i18n ready** | JSON translation files in `resources/lang/` |

---

## 🚀 Installation

```bash
composer require meubleo/shop
php artisan meubleo:install
```

That's it. `meubleo:install` will:
1. Publish config, migrations, stubs and assets
2. Run `php artisan migrate`
3. Run `php artisan storage:link`

Then create an admin user:

```bash
php artisan meubleo:admin
# or with arguments:
php artisan meubleo:admin "John Doe" john@example.com secret123
```

---

## ⚙️ Configuration

After install, edit `config/meubleo.php`:

```php
return [
    'prefix'   => 'admin',          // Admin URL prefix
    'provider' => \App\Meubleo\MeubleoServiceProvider::class,
    'shop_name' => 'My Shop',
    'tax_rate'  => 0.20,
    'free_shipping_threshold' => 500,
    'shipping_cost'           => 29.90,
    'stripe' => [
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
];
```

---

## 🧩 Screen pattern

Create a screen:
```bash
php artisan meubleo:screen ProductListScreen
```

```php
// app/Meubleo/Screens/ProductListScreen.php
class ProductListScreen extends Screen
{
    public function query(): iterable
    {
        return ['products' => Product::paginate(20)];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('New')->icon('bs.plus')->route('meubleo.admin.products.create'),
        ];
    }

    public function layout(): iterable
    {
        return [ProductTableLayout::class];
    }
}
```

---

## 📋 Table layout

```bash
php artisan meubleo:table ProductTableLayout
```

```php
class ProductTableLayout extends Table
{
    protected string $target = 'products';

    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Product')->sort(),
            TD::make('price', 'Price')
                ->alignRight()
                ->render(fn($p) => meubleo_price($p->price)),
            TD::make('stock', 'Stock')
                ->render(fn($p) => '<span class="badge bg-success">'.$p->stock.'</span>'),
        ];
    }
}
```

---

## 📝 Rows layout (forms)

```bash
php artisan meubleo:rows ProductFormLayout
```

```php
class ProductFormLayout extends Rows
{
    protected function fields(): iterable
    {
        return [
            Input::make('product.name')->title('Name')->required(),
            Select::make('product.category_id')
                ->fromModel(Category::class, 'name')
                ->title('Category'),
            Input::make('product.price')->title('Price')->type('number'),
            Switcher::make('product.is_featured')->title('Featured'),
        ];
    }
}
```

---

## 📦 Artisan commands

| Command | Description |
|---|---|
| `meubleo:install` | Full installation (publish + migrate) |
| `meubleo:admin [name] [email] [password]` | Create/update admin user |
| `meubleo:screen ClassName` | Generate a Screen class |
| `meubleo:table ClassName` | Generate a Table Layout |
| `meubleo:rows ClassName` | Generate a Rows Layout |
| `meubleo:filter ClassName` | Generate a Filter class |
| `meubleo:publish [--config\|--views\|--assets\|--migrations\|--stubs]` | Publish specific assets |

---

## 🗂️ Package structure

```
src/
├── Platform/
│   ├── Shop.php                      ← Central singleton registry
│   ├── MeubleoServiceProvider.php    ← Abstract provider to extend
│   ├── Providers/
│   │   ├── FoundationServiceProvider ← Auto-discovered entry point
│   │   ├── ConsoleServiceProvider    ← Artisan commands + publish tags
│   │   ├── RouteServiceProvider      ← Loads routes
│   │   └── PlatformServiceProvider   ← Loads user's provider
│   ├── Commands/                     ← meubleo:install, screen, table…
│   ├── Http/
│   │   ├── Controllers/              ← Shop + Cart + Checkout + Orders
│   │   ├── Screens/                  ← DashboardScreen, ProductListScreen…
│   │   ├── Layouts/                  ← ProductTableLayout, ProductFormLayout
│   │   └── Middleware/AdminMiddleware
│   ├── Models/                       ← Product, Category, Order… (meubleo_* tables)
│   └── Services/                     ← CartService, OrderService
├── Screen/
│   ├── Screen.php                    ← Abstract base screen
│   ├── Field.php                     ← Abstract field with fluent API
│   ├── Layout.php, TD.php, Action.php
│   ├── Fields/    Input, Select, TextArea, Switcher, Password, DateTimer…
│   ├── Layouts/   Table, Rows (abstract)
│   └── Actions/   Button, Link, Menu
├── Filters/Filter.php
└── Support/
    ├── Toast.php
    ├── helpers.php                   ← toast(), meubleo_price(), meubleo_prefix()
    └── Facades/  Shop, Cart

stubs/app/Meubleo/               ← Published to app/Meubleo/ on install
    MeubleoServiceProvider.php
    Screens/Product/ProductListScreen.php
    Layouts/Product/ProductTableLayout.php
    Filters/ProductNameFilter.php
    routes/meubleo.php
```

---

## 💳 Stripe test card

`4242 4242 4242 4242` — any future date, any CVV.

---

## 📜 License

MIT
