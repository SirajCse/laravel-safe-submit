## README


>>>
##Preventing Duplicate Form  Submits  in Laravel framework
=======
Quickly submitting a form more than once can store duplicate entity in database. This package handle the server-side solution while submitting the data.

# Installation

    composer require SirajCSE/laravel-safe-submit

Laravel uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

### Laravel without auto-discovery:

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
SirajCSE\LaravelSafeSubmit\SafeSubmitServiceProvider::class,
```

If you want to use the facade to log messages, add this to your facades in app.php:

```php
'SafeSubmit' => SirajCSE\LaravelSafeSubmit\SafeSubmit::class,
```

### Laravel Kernel (Middleware):

Make sure to add GenerateSafeSubmitToken to your Kernel list in `app/Http/Kernel.php`.

```php
    \SirajCSE\LaravelSafeSubmit\Middleware\GenerateSafeSubmitToken::class
```

Like this
```php
    protected $middlewareGroups = [
            'web' => [
                ...
                \SirajCSE\LaravelSafeSubmit\Middleware\GenerateSafeSubmitToken::class,
            ],
        ];
```


### Laravel Controller:

Make sure to add __construct middleware of your 'method' and 'return' intended function

```php
        use SirajCSE\LaravelSafeSubmit\SafeSubmit;
        use SirajCSE\LaravelSafeSubmit\Middleware\HandleSafeSubmit;
```

Example 
```php
    use SirajCSE\LaravelSafeSubmit\SafeSubmit;
    use SirajCSE\LaravelSafeSubmit\Middleware\HandleSafeSubmit;
    
    class UserController extends Controller
    {
        public function __construct()
        {
            $this->middleware(HandleSafeSubmit::class)->only('store');
        }
        
  
        public function store(Request $request, SafeSubmit $safeSubmit)
        {
            $user=User::create($data);
            return $safeSubmit->intended(route('users.show', $user->id));
        }
    }
```



### Laravel Blade:

Add '@safesubmit' inside Form below  Like @csrf

```php
        @safesubmit
```

Example 
```
   <form action="{{ route('users.store') }}" method="post">
       @csrf
       @safesubmit
   
       <button type="submit">Create User</button>
   </form>
```
