@extends('backend.app')

@section('title')
    Profile
@endsection



@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User / </span> View</h4>
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-6 col-lg-8 col-md-8 order-1 order-md-0 mx-auto">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                src="{{ asset($data->avatar ?? '/frontend/assets/img/avatars/15.png') }}" height="100"
                                width="100" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ $data->name }}</h4>
                                <span class="badge bg-label-secondary mt-1">{{ ucfirst($data->role) }}</span>
                                <p class="text-center">{{ $data->bio }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-semibold me-1">Name:</span>
                                <span>{{ $data->name }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Email:</span>
                                <span>{{ $data->email }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Status:</span>
                                <span class="badge bg-label-success">{{ ucfirst($data->status) }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Role:</span>
                                <span>{{ $data->role }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Phone:</span>
                                <span>{{ $data->phone ?? 'N/A' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Address:</span>
                                <span>{{ $data->address ?? 'N/A' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Birth Date:</span>
                                <span>{{ $data->date_of_birth ?? 'N/A' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Gender:</span>
                                <span>{{ ucfirst($data->gender) ?? 'N/A' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Last Login:</span>
                                <span>{{ $data->last_login_at ?? 'N/A' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">last_login_ip:</span>
                                <span>{{ $data->last_login_ip ?? 'N/A' }}</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                data-bs-toggle="modal">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /User Card -->

            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form id="" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="alert alert-warning" role="alert">
                            <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                            <span>Minimum 8 characters long, uppercase & symbol</span>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-sm-12 form-password-toggle">
                                <label class="form-label" for="current_password">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="current_password"
                                        id="current_password" placeholder="••••••••••••" />
                                    <span class="input-group-text cursor-pointer toggle-password">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                                @error('current_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="password" id="password"
                                        placeholder="••••••••••••" />
                                    <span class="input-group-text cursor-pointer toggle-password">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" placeholder="••••••••••••" />
                                    <span class="input-group-text cursor-pointer toggle-password">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary me-2">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Change Password -->


        </div>
        <!--/ User Sidebar -->

    </div>

    <!-- Modals -->
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="text-center mb-4">
                        <h3 class="mb-2">Edit User Information</h3>
                        <p class="text-muted">Update the user details below.</p>
                    </div>

                    <form id="" action="{{ route('backend.admin.profile.update') }}" method="POST"
                        enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" value="{{ $data->name }}" id="name" name="name"
                                class="form-control" placeholder="John Doe" />
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" value="{{ $data->email }}" name="email"
                                class="form-control" placeholder="example@domain.com" />
                        </div>

                        <!-- Password -->
                        {{-- <div class="col-12 col-md-6">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="••••••••" />
                            </div> --}}

                        <!-- Role -->
                        {{-- {{ $data }} --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="role">Role</label>
                            <select id="role" name="role" class="form-select">
                                @foreach (['super_admin', 'admin', 'manager', 'editor', 'user'] as $role)
                                    <option value="{{ $role }}" @selected($data->role === $role)>
                                        {{ ucwords(str_replace('_', ' ', $role)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Phone -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" value="{{ $data->phone }}" name="phone"
                                class="form-control" placeholder="+1 234 567 890" />
                        </div>

                        <!-- Address -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" id="address" value="{{ $data->address }}" name="address"
                                class="form-control" placeholder="123 Street, City" />
                        </div>

                        <!-- Avatar -->
                        <div class="col-12">
                            <label class="form-label" for="avatar">Avatar</label>
                            <input type="file" id="avatar" name="avatar" class="form-control" />
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="date_of_birth">Date of Birth</label>
                            <input type="text" id="eventStartDate" value="{{ $data->date_of_birth }}"
                                name="date_of_birth" class="form-control" />
                        </div>

                        <!-- Gender -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-select">
                                <option value="">Select</option>
                                <option value="male" @selected($data->gender === 'male')>Male</option>
                                <option value="female" @selected($data->gender === 'female')>Female</option>
                                <option value="other" @selected($data->gender === 'other')>Other</option>
                            </select>
                        </div>

                        <!-- Bio -->
                        <div class="col-12">
                            <label class="form-label" for="bio">Bio</label>
                            <textarea id="bio" name="bio" class="form-control" rows="3"
                                placeholder="Write something about user...">{{ $data->bio }}</textarea>
                        </div>

                        <!-- Social Links -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="facebook_url">Facebook</label>
                            <input type="url" id="facebook_url" name="facebook_url"
                                value="{{ $data->facebook_url }}" class="form-control"
                                placeholder="https://facebook.com/username" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="twitter_url">Twitter</label>
                            <input type="url" id="twitter_url" name="twitter_url" value="{{ $data->twitter_url }}"
                                class="form-control" placeholder="https://twitter.com/username" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="linkedin_url">LinkedIn</label>
                            <input type="url" id="linkedin_url" name="linkedin_url"
                                value="{{ $data->facebook_url }}" class="form-control"
                                placeholder="https://linkedin.com/in/username" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="instagram_url">Instagram</label>
                            <input type="url" id="instagram_url" name="instagram_url"
                                value="{{ $data->instagram_url }}" class="form-control"
                                placeholder="https://instagram.com/username" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="website">Website</label>
                            <input type="url" id="website" name="website" value="{{ $data->website }}"
                                class="form-control" placeholder="https://example.com" />
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="active" @selected($data->status == 'active')>Active</option>
                                <option value="inactive" @selected($data->status == 'inactive')>Inactive</option>
                                <option value="suspended" @selected($data->status == 'suspended')>Suspended</option>
                            </select>
                        </div>

                        <!-- Last Login (readonly) -->
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="last_login_at">Last Login</label>
                            <input type="text" id="last_login_at" name="last_login_at"
                                value="{{ $data->last_login_at }}" class="form-control" readonly />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="last_login_ip">Last Login IP</label>
                            <input type="text" id="last_login_ip" name="last_login_ip"
                                value="{{ $data->last_login_ip }}" class="form-control" readonly />
                        </div>

                        <!-- Submit / Cancel -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Save Changes</button>
                            <button type="reset" class="btn btn-label-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--/ Edit User Modal -->


    <!-- /Modals -->
@endsection
@push('scripts')
    <!-- Custom JS (optional) -->
    <script src="{{ asset('frontend/assets/js/modal-edit-user.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/modal-enable-otp.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app-user-view.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app-user-view-security.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/app-user-view-security.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const eventStartDate = document.querySelector('#eventStartDate');

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
@endpush
