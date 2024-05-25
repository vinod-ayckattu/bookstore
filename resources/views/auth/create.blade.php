<x-layout>
<x-navigation :links="['Home' => route('reader.books.index'), 'Sign In' => '#']" />
    <div class="row my-5">
        <div class="col-sm"></div>
        <div class="col-sm d-inline-flex justify-content-center py-5 px-3  border borded-2 bg-card rounded-3">
            <form action="{{ route('auth.store') }}" method="POST">
                @csrf
                <h5>Sign In to Online Books Store</h5>
                @session('error')
                <div class="text-danger">{{ $value }}</div>
                @endsession
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <label for="password" class="form-label mt-3">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="checkbox" name="remember" class="form-check-input"><label for="remember" class="form-label">&nbsp Remember me</label>
                <span class="d-flex align-items-end"><button class="btn btn-primary mt-3">Sign In</button></span>
                <a href="#" class="float-end text-decoration-none">Forgot Password?</a>
            </form>
        </div>
        <div class="col-sm"></div>
    </div>
</x-layout>
