<h1>
    Hello World!
</h1>

@auth
    <form method="POST" action="/logout">
        @csrf

        <button type="submit">
            Sair
        </button>
    </form>
@endauth
