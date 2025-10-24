@extends('backend.app')

@section('title')
    User List
@endsection

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endpush

@section('content')
    <!-- Users List Table -->
    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('backend.business.category.store') }}"
                method="POST"
                class="space-y-4">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name"
                        class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="mt-1 block form-control w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter category name"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description (optional) -->
                <div class="mb-3">
                    <label for="description"
                        class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description"
                        id="description"
                        class="mt-1 form-control block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter category description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="btn btn-primary bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                        Save Category
                    </button>
                </div>
            </form>

        </div>


        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end"
            tabindex="-1"
            id="offcanvasAddUser"
            aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel"
                    class="offcanvas-title">Add User</h5>
                <button type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-user pt-0"
                    id="addNewUserForm"
                    method="POST"
                    action="{{ route('backend.user.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text"
                            class="form-control"
                            name="name"
                            required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                            class="form-control"
                            name="email"
                            required />
                    </div>


                    <div class="mb-3 form-password-toggle">
                        <label class="form-label"
                            for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control password"
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••••••" />
                            <span class="input-group-text cursor-pointer toggle-password">
                                <i class="ti ti-eye-off"></i>
                            </span>
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select"
                            name="role"
                            required>
                            <option value="subscriber">Subscriber</option>
                            <option value="editor">Editor</option>
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text"
                            class="form-control"
                            name="phone" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text"
                            class="form-control"
                            name="address" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        <input type="file"
                            class="form-control"
                            name="avatar"
                            accept="image/*" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label"
                            for="birthDate">Date of Birth</label>
                        <input type="text"
                            id="birthDate"
                            value=""
                            name="date_of_birth"
                            class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select"
                            name="gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control"
                            name="bio"
                            rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Facebook URL</label>
                        <input type="url"
                            class="form-control"
                            name="facebook_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Twitter URL</label>
                        <input type="url"
                            class="form-control"
                            name="twitter_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url"
                            class="form-control"
                            name="linkedin_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instagram URL</label>
                        <input type="url"
                            class="form-control"
                            name="instagram_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <input type="url"
                            class="form-control"
                            name="website" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select"
                            name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="banned">Banned</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Login At</label>
                        <input type="datetime-local"
                            class="form-control"
                            name="last_login_at" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Login IP</label>
                        <input type="text"
                            class="form-control"
                            name="last_login_ip" />
                    </div>

                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    <button type="reset"
                        class="btn btn-label-secondary"
                        data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <!-- Custom JS (optional) -->
    <script src="{{ asset('frontend/assets/js/app-user-list.js') }}"></script>

    <!-- DataTable initialization -->
    <script>
        $(document).ready(function() {
            var table = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('backend.business.category.index') }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                        searchable: true
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Custom search input
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-password").forEach(function(toggle) {
                toggle.addEventListener("click", function() {
                    let input = this.parentElement.querySelector("input");
                    let icon = this.querySelector("i");

                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove("ti-eye-off");
                        icon.classList.add("ti-eye");
                    } else {
                        input.type = "password";
                        icon.classList.remove("ti-eye");
                        icon.classList.add("ti-eye-off");
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const eventStartDate = document.querySelector('#birthDate');

            if (eventStartDate) {
                flatpickr(eventStartDate, {
                    enableTime: true,
                    dateFormat: "Y-m-d\\TH:i:S", // proper datetime format
                    // altFormat: 'Y-m-dTH:i:S',
                    altInput: true,
                    onReady: function(selectedDates, dateStr, instance) {
                        if (instance.isMobile) {
                            instance.mobileInput.setAttribute('step', null);
                        }
                    }
                });
            }
        });
    </script>
@endpush
