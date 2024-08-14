<div>
    <h1>Login Vendedor</h1>
    <form method="POST" action="{{ route('vendedor.login.ingresar') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
