<x-layout>

    <section class="section main-section">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-lock"></i></span>
                    Login
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action={{ route('login') }}>
                    @csrf
                    <div class="field spaced">
                        <label class="label">Login</label>
                        <div class="control icons-left">
                            <input class="input @error('email') is-invalid @enderror" type="text" name="email"
                                placeholder="user@example.com" autocomplete="username" value="{{ old('email') }}">
                            <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                        </div>
                        <p class="help">
                            Please enter your login
                        </p>
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field spaced">
                        <label class="label">Password</label>
                        <p class="control icons-left">
                            <input class="input  @error('password') is-invalid @enderror" type="password"
                                name="password" placeholder="Password" autocomplete="current-password">
                            <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                        </p>
                        <p class="help">
                            Please enter your password
                        </p>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field spaced">
                        <div class="control">
                            <label class="checkbox"><input type="checkbox" name="remember" value="1" checked>
                                <span class="check"></span>
                                <span class="control-label">Remember</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="field grouped">
                        <div class="control">
                            <button type="submit" class="button blue">
                                Login
                            </button>
                        </div>
                        <div class="control">
                            <a href="index.html" class="button">
                                Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-layout>
