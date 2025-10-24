@extends('backend.app')

@section('title')
    User List
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endpush

@section('content')

    
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title mb-3">Business Categories</h5>
                </div>
                <div class="col-6 ms-auto text-end">
                    <a href="{{route('backend.business.category.create')}}" class="btn btn-primary ms-auto text-end mb-3">+ Add new</a>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        {{-- <div class="row my-4 mx-2">
            <div class="col-md-2">
                <div class="me-3">
                    <div class="dataTables_length" id="DataTables_Table_0_length"><label><select
                                name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select></label></div>
                </div>
            </div>
            <div class="col-md-10">
                <div
                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                                class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0"></label>
                    </div>
                    <div class="dt-buttons btn-group flex-wrap">
                        <div class="btn-group"><button
                                class="btn btn-secondary buttons-collection dropdown-toggle btn-label-secondary mx-3"
                                tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"
                                aria-expanded="false"><span><i class="ti ti-screen-share me-1 ti-xs"></i>Export</span><span
                                    class="dt-down-arrow"></span></button></div> <button
                            class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i
                                    class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New
                                    User</span></span></button>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="card-datatable table-responsive p-4">
            <table class="" id="userTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>role</th>
                        <th>Status</th>
                        <th>Join at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>


        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-user pt-0" id="addNewUserForm" method="POST"
                    action="{{ route('backend.user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required />
                    </div>


                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control password" type="password" name="password" id="password"
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
                        <select class="form-select" name="role" required>
                            <option value="subscriber">Subscriber</option>
                            <option value="editor">Editor</option>
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        <input type="file" class="form-control" name="avatar" accept="image/*" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="birthDate">Date of Birth</label>
                        <input type="text" id="birthDate" value="" name="date_of_birth"
                            class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" name="facebook_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" class="form-control" name="twitter_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" name="linkedin_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" name="instagram_url" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" class="form-control" name="website" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="banned">Banned</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Login At</label>
                        <input type="datetime-local" class="form-control" name="last_login_at" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Login IP</label>
                        <input type="text" class="form-control" name="last_login_ip" />
                    </div>

                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
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
