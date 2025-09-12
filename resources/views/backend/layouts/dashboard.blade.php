@extends('backend.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            {{-- <span>Total User</span> --}}
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $total }}</h4>
                                <!-- <span class="text-success">(+29%)</span> -->
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
                            {{-- <span>Users</span> --}}
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $user }}</h4>
                                {{-- <span class="text-success">(+18%)</span> --}}
                            </div>
                            <span>Users</span>
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
                            {{-- <span>Active Users</span> --}}
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $active }}</h4>
                                {{-- <span class="text-danger">(-14%)</span> --}}
                            </div>
                            <span>Active Users</span>
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
                            {{-- <span>Inactive Users</span> --}}
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $inactive }}</h4>
                                {{-- <span class="text-success">(+42%)</span> --}}
                            </div>
                            <span>Inactive Users</span>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
