# livewire-blog-compontents
The livewire implementation for my blog content editor.

# General Setup
I assume that you have already run `php artisan make:auth`

Copy the files in this repo into their appropriate location.

Run `php artisan migrate`

# Livewire Setup
`composer require calebporzio/livewire`

Add the livewire assets to `layouts/app.blade.php`

```...
    @livewireAssets
</body>
</html>
```

Include `@livewire('posts')` wherever you want to include this livewire component

# A note on styling
I used tailwindcss, but feel free to strip the classes off post.blade.php and use whatever you are using in your project.


