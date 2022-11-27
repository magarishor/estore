<form action="{{ route('front.user.password') }}" method="post">
    @method('patch')
    @csrf
    <div class="mb-3">
        <label for="old_password" class="form-label">Old Password</label>
        <input type="password" name="old_password" id="old_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" name="new_password" id="new_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="new_password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-outline-primary">
            <i class="fa-solid fa-save me-2"></i>
            Save
        </button>
    </div>
</form>
