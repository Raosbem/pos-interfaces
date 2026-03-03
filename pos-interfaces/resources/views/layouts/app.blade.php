<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema POS - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pos-dark': '#1a2942',
                        'pos-blue': '#1e3a5f',
                        'pos-mid': '#2d5282',
                        'pos-accent': '#3b82f6',
                        'pos-light': '#e8f0fe',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .mono { font-family: 'DM Mono', monospace; }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-800">
    @yield('content')
    @yield('scripts')
</body>
</html>