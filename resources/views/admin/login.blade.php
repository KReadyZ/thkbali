<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — THK Bali</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-forest-950 text-white min-h-screen flex items-center justify-center p-6 bg-cover bg-center relative" 
      style="background-image: linear-gradient(rgba(4, 28, 21, 0.75), rgba(4, 28, 21, 0.9)), url('https://images.unsplash.com/photo-1508672019048-805c876b67e2?auto=format&fit=crop&w=1920&q=80');">
    
    <div class="w-full max-w-md bg-forest-900/80 backdrop-blur-md border border-gold-500/30 rounded-3xl p-8 shadow-2xl">
        <!-- Logo and Heading -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gold-500/10 rounded-full border border-gold-500/20 mb-4">
                <svg class="w-9 h-9 text-gold-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="9" r="6" stroke="currentColor" />
                    <circle cx="8" cy="15" r="6" stroke="currentColor" />
                    <circle cx="16" cy="15" r="6" stroke="currentColor" />
                </svg>
            </div>
            <h1 class="font-serif text-2xl font-bold text-white mb-1">Back Office THK Bali</h1>
            <p class="text-xs text-gold-400 font-semibold tracking-widest uppercase">Admin Authentication</p>
        </div>

        <!-- Alert messages -->
        @if($errors->has('auth'))
            <div class="bg-red-900/50 border border-red-500/30 text-red-200 rounded-2xl p-4 mb-6 text-sm flex items-start gap-2.5">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $errors->first('auth') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-forest-500/20 border border-forest-500/30 text-white rounded-2xl p-4 mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-white/70 uppercase mb-2" for="email">Alamat Email</label>
                <input class="w-full bg-forest-950/80 border border-white/10 rounded-2xl px-4 py-3.5 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition" 
                       type="email" id="email" name="email" required placeholder="admin@thkbali.com" value="{{ old('email') }}">
            </div>
            <div>
                <label class="block text-xs font-semibold text-white/70 uppercase mb-2" for="password">Password</label>
                <input class="w-full bg-forest-950/80 border border-white/10 rounded-2xl px-4 py-3.5 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition" 
                       type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            
            <button type="submit" class="w-full py-4 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-2xl transition-all duration-300 text-sm mt-8 shadow-lg hover:shadow-gold-500/20">
                Masuk Sekarang
            </button>
        </form>
        
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="text-xs text-white/40 hover:text-gold-400 transition inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
