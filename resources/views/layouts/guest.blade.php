<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ setting('site_name', config('app.name', 'Laravel')) }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              400: '#7c8fff',
              500: '#5164ff',
              600: '#3b4df2',
              700: '#2c3bc6'
            },
            ink: '#0b1221'
          }
        }
      }
    };
  </script>
</head>

<body class="bg-gradient-to-tr from-slate-100 via-slate-50 to-white text-slate-900 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden p-6 sm:p-8 space-y-6">
    <div class="text-center">
      <a href="/">
        <img src="{{ setting('site_logo') ? asset('storage/' . setting('site_logo')) : asset('logo.jpeg') }}" class="h-10 w-auto object-contain mx-auto mb-4" alt="Logo" />
      </a>
      {{ $header ?? '' }}
    </div>

    {{ $slot }}
  </div>
</body>

</html>
