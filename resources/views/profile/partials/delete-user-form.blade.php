<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>
    <!-- Delete Account Button -->
    <button class="btn btn-danger" onclick="openModal('confirm-user-deletion')">
        Delete Account
    </button>

    <!-- Modal for Confirming Account Deletion -->
    <div id="confirm-user-deletion" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete your account?</h5>
                    <button type="button" class="close" onclick="closeModal('confirm-user-deletion')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        <p>
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                            Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <!-- Password Input -->
                        <div class="form-group mt-3">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- Cancel Button -->
                        <button type="button" class="btn btn-secondary" onclick="closeModal('confirm-user-deletion')">
                            Cancel
                        </button>

                        <!-- Delete Button -->
                        <button type="submit" class="btn btn-danger ms-3">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
