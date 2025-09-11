@extends('backend.app')

@section('title')
    User List
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">21,459</h4>
                                <span class="text-success">(+29%)</span>
                            </div>
                            <span>Total Users</span>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="ti ti-user ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Paid Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">4,567</h4>
                                <span class="text-success">(+18%)</span>
                            </div>
                            <span>Last week analytics </span>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <i class="ti ti-user-plus ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">19,860</h4>
                                <span class="text-danger">(-14%)</span>
                            </div>
                            <span>Last week analytics</span>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="ti ti-user-check ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">237</h4>
                                <span class="text-success">(+42%)</span>
                            </div>
                            <span>Last week analytics</span>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Search Filter</h5>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="row my-4 mx-2">
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
        </div>
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
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                    <div class="mb-3">
                        <label class="form-label" for="add-user-fullname">Full Name</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                            name="userFullname" aria-label="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input type="text" id="add-user-email" class="form-control"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-contact">Contact</label>
                        <input type="text" id="add-user-contact" class="form-control phone-mask"
                            placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-company">Company</label>
                        <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer"
                            aria-label="jdoe1" name="companyName" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="country">Country</label>
                        <select id="country" class="select2 form-select">
                            <option value="">Select</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class="form-select">
                            <option value="subscriber">Subscriber</option>
                            <option value="editor">Editor</option>
                            <option value="maintainer">Maintainer</option>
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="user-plan">Select Plan</label>
                        <select id="user-plan" class="form-select">
                            <option value="basic">Basic</option>
                            <option value="enterprise">Enterprise</option>
                            <option value="company">Company</option>
                            <option value="team">Team</option>
                        </select>
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
                ajax: '{{ route('backend.user.list') }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'role',
                        name: 'role',
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
@endpush
