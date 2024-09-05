<div class="login-container">
    <h1>Login Admin</h1>
    
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" wire:model="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" wire:model="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
