<h2>Edit Profile</h2>
<form action="{{ route('front.user.profile') }}" method="post">
    @method('patch')
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control-plaintext" value="{{ $user->email }}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Phone</label>
        <input type="text" name="phone" id="name" class="form-control" value="{{ old('phone', $user->phone) }}" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Address</label>
        <textarea name="address" id="address" class="form-control" required>{{ old('address', $user->address) }}</textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-outline-primary">
            <i class="fa-solid fa-save me-2"></i>
            Save
        </button>
    </div>
</form>
