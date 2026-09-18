<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="w-full min-h-screen flex bg-default font-ancizar">
        <section class="w-full p-8 relative">
            <h1 class="relative z-20 text-3xl">GoodFocus97</h1>
            <div class="absolute inset-0 z-10 bg-[linear-gradient(-90deg,rgba(239,249,231,1)_0%,rgba(239,249,231,0.01)_10%)]"></div>
            <img src="../../../storage/pictures/background.jpg" class="absolute inset-0 z-0 w-full h-full object-cover" alt="">
        </section>
        <section class="w-350 flex items-center justify-center">
            <form method="POST" action="/login" class="flex flex-col gap-8">
                @csrf
                <span>
                    <h1 class="text-3xl mb-3">Bem vindo de volta</h1>
                    <h3 class="text-lg text-muted">Faça login para acessar o painel do GoodFocus97</h3>
                </span>            
                <label for="email" class="block">
                    <p class="text-lg mb-2.5">E-mail</p>
                    <div class="relative w-100">
                        <x-heroicon-o-envelope class="w-5 h-5 text-muted absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" />
                        <input
                            type="email"
                            placeholder="seu@email.com"
                            id="email"
                            name="email"
                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-muted
                                placeholder:text-muted placeholder:opacity-70"
                            required
                        />
                    </div>
                </label>
                <label for="password" class="block">
                    <p class="text-lg mb-2.5">Senha</p>
                    <div class="relative w-100">
                        <x-heroicon-o-lock-closed class="w-5 h-5 text-muted absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" />
                        <input
                            type="password"
                            placeholder="Digite sua senha"
                            id="password"
                            name="password"
                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-muted
                                placeholder:text-muted placeholder:opacity-70"
                            required
                        />
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer" id="eyeBtn">
                            <x-heroicon-o-eye-slash id="eyeSlash" class="w-5 h-5 text-muted"/>
                            <x-heroicon-o-eye id="eyeOpen" class="hidden w-5 h-5 text-muted"/>
                        </div>
                    </div>
                </label>
                @error('email')
                    <span class="text-red-500">
                        {{ $message }}
                    </span>
                @enderror
                <button type="submit" class="cursor-pointer bg-primary py-4 rounded-lg text-white font-light text-xl">Entrar</button>
            </form>
        </section>
    </main>
</body>
</html>

<script>
    const passwordInput = document.getElementById("password");
    const eyeBtn = document.getElementById("eyeBtn");
    const eyeSlash = document.getElementById("eyeSlash");
    const eyeOpen = document.getElementById("eyeOpen");

    eyeBtn.addEventListener("click", () => {
        const isPassword = passwordInput.type === "password";

        passwordInput.type = isPassword ? "text" : "password";

        eyeSlash.classList.toggle("hidden", isPassword);
        eyeOpen.classList.toggle("hidden", !isPassword);
    });


</script>