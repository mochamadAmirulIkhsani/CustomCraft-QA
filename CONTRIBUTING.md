# Contributing to CustomCraft

We love your input! We want to make contributing to CustomCraft as easy and transparent as possible, whether it's:

-   Reporting a bug
-   Discussing the current state of the code
-   Submitting a fix
-   Proposing new features
-   Becoming a maintainer

## Development Process

We use GitHub to host code, to track issues and feature requests, as well as accept pull requests.

## Pull Requests

Pull requests are the best way to propose changes to the codebase. We actively welcome your pull requests:

1. Fork the repo and create your branch from `main`.
2. If you've added code that should be tested, add tests.
3. If you've changed APIs, update the documentation.
4. Ensure the test suite passes.
5. Make sure your code lints.
6. Issue that pull request!

## Development Setup

1. **Fork and Clone**

    ```bash
    git clone https://github.com/your-username/CustomCraft-QA.git
    cd CustomCraft-Laravel_CRUD
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment Setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database Setup**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5. **Create Branch**
    ```bash
    git checkout -b feature/your-feature-name
    ```

## Code Style

-   Follow PSR-12 coding standards for PHP
-   Use Laravel conventions and best practices
-   Use meaningful variable and function names
-   Add comments for complex logic
-   Keep functions small and focused

### PHP Code Style

```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $products = Product::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }
}
```

### Blade Template Style

```blade
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

        @if($items->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($items as $item)
                    <div class="card">
                        <h2>{{ $item->name }}</h2>
                        <p>{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No items found.</p>
        @endif
    </div>
@endsection
```

## Commit Messages

Write clear and meaningful commit messages:

-   Use the present tense ("Add feature" not "Added feature")
-   Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
-   Limit the first line to 72 characters or less
-   Reference issues and pull requests liberally after the first line

### Examples:

```
Add user authentication system

- Implement login/logout functionality
- Add password reset feature
- Create user registration flow
- Fixes #123
```

## Testing

-   Write tests for new features
-   Ensure all tests pass before submitting PR
-   Include both unit and feature tests where appropriate

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ProductTest
```

## Database Changes

When making database changes:

1. **Create Migration**

    ```bash
    php artisan make:migration create_example_table
    ```

2. **Update Model**

    ```php
    protected $fillable = ['name', 'description'];
    protected $casts = ['is_active' => 'boolean'];
    ```

3. **Create/Update Seeder**

    ```bash
    php artisan make:seeder ExampleSeeder
    ```

4. **Update Factory (if needed)**
    ```bash
    php artisan make:factory ExampleFactory
    ```

## Adding New Features

When adding new features:

1. **Controller** - Handle HTTP requests
2. **Model** - Define data structure and relationships
3. **Migration** - Database schema changes
4. **Views** - User interface templates
5. **Routes** - URL endpoints
6. **Tests** - Automated testing
7. **Documentation** - Update README if needed

## Bug Reports

Great Bug Reports tend to have:

-   A quick summary and/or background
-   Steps to reproduce
    -   Be specific!
    -   Give sample code if you can
-   What you expected would happen
-   What actually happens
-   Notes (possibly including why you think this might be happening, or stuff you tried that didn't work)

## Feature Requests

We love feature requests! Please provide:

-   Clear description of the feature
-   Why you need it
-   How it should work
-   Any design mockups or examples

## Code Review Process

The core team looks at Pull Requests on a regular basis. After feedback has been given we expect responses within two weeks. After two weeks we may close the pull request if it isn't showing any activity.

## Community

You can chat with the core team on:

-   GitHub Discussions
-   GitHub Issues
-   Email: support@customcraft.com

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

## Recognition

Contributors will be recognized in our README file and release notes.

Thank you for contributing to CustomCraft! 🎉
