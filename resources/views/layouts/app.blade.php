<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Late Night Blog')</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
        }
        .glass {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        }
        .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen">
    <nav class="glass sticky top-0 z-50 py-4 mb-8">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('blogs.index') }}" class="text-2xl font-bold gradient-text">BlogSystem</a>
            <div class="flex gap-6">
                <a href="{{ route('blogs.index') }}" class="hover:text-indigo-400 transition">Dashboard</a>
                <a href="{{ route('categories.index') }}" class="hover:text-pink-400 transition">Categories</a>
                <a href="{{ route('blogs.create') }}" class="hover:text-indigo-400 transition">New Blog</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 pb-20">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/50 text-emerald-400">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-500/20 border border-rose-500/50 text-rose-400">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="py-10 text-center text-slate-500 text-sm border-t border-slate-800 mt-20">
        &copy; {{ date('Y') }} MD Mishkatul Asfim. Built with Laravel.
    </footer>
</body>
</html>
