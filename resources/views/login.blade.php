<x-layout>
    <h1>Formulário de Login</h1>
    @if (isset($message))
        <h1>{{ $message }}</h1>
    @endif
     <form method="POST" action="/login" class="flex flex-col gap-4" enctype="multipart/form-data">
        @csrf
        <label for="email">
            E-mail:
            <br>
            <input type="text" name="email" id="email" required maxlength="255" class="border w-full">
        </label>
        <label for="password">
            Senha
            <br>
            <input type="password" name="password" id="password" required class="border w-full">
        </label>
        <button id="btn" class="border bg-amber-300 cursor-pointer">Entrar</button>
    </form>
    @auth
        <a href="/logout">Sair</a>
    @endauth
</x-layout>