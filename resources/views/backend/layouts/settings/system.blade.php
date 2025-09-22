@extends('backend.app')

@section('title')
    user details
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header text-white">
            <h4 class="mb-0">Update System Settings</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4"
                    id="settingsTab"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                            id="general-tab"
                            data-bs-toggle="tab"
                            href="#general"
                            role="tab">General Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            id="seo-tab"
                            data-bs-toggle="tab"
                            href="#seo"
                            role="tab">SEO Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            id="social-tab"
                            data-bs-toggle="tab"
                            href="#social"
                            role="tab">Social Media</a>
                    </li>
                </ul>

                <div class="tab-content"
                    id="settingsTabContent">
                    <!-- General Info -->
                    <div class="tab-pane fade show active"
                        id="general"
                        role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Site Name</label>
                            <input type="text"
                                name="site_name"
                                value="{{ old('site_name', $settings->site_name) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file"
                                name="logo"
                                class="dropify"
                                data-default-file="{{ $settings->logo ? asset($settings->logo) : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Favicon</label>
                            <input type="file"
                                name="favicon"
                                class="dropify"
                                data-default-file="{{ $settings->favicon ? asset($settings->favicon) : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email"
                                name="contact_email"
                                value="{{ old('contact_email', $settings->contact_email) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Phone</label>
                            <input type="text"
                                name="contact_phone"
                                value="{{ old('contact_phone', $settings->contact_phone) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text"
                                name="address"
                                value="{{ old('address', $settings->address) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">About</label>
                            <textarea name="about"
                                rows="3"
                                class="form-control">{{ old('about', $settings->about) }}</textarea>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="tab-pane fade"
                        id="seo"
                        role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text"
                                name="meta_title"
                                value="{{ old('meta_title', $settings->meta_title) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description"
                                rows="3"
                                class="form-control">{{ old('meta_description', $settings->meta_description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <textarea name="meta_keywords"
                                rows="3"
                                class="form-control">{{ old('meta_keywords', $settings->meta_keywords) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">OG Title</label>
                            <input type="text"
                                name="og_title"
                                value="{{ old('og_title', $settings->og_title) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">OG Description</label>
                            <textarea name="og_description"
                                rows="3"
                                class="form-control">{{ old('og_description', $settings->og_description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">OG Image</label>
                            <input type="file"
                                name="og_image"
                                class="dropify"
                                data-default-file="{{ $settings->og_image ? asset($settings->og_image) : '' }}">
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="tab-pane fade"
                        id="social"
                        role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="url"
                                name="facebook_url"
                                value="{{ old('facebook_url', $settings->facebook_url) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="url"
                                name="twitter_url"
                                value="{{ old('twitter_url', $settings->twitter_url) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input type="url"
                                name="linkedin_url"
                                value="{{ old('linkedin_url', $settings->linkedin_url) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="url"
                                name="instagram_url"
                                value="{{ old('instagram_url', $settings->instagram_url) }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">YouTube</label>
                            <input type="url"
                                name="youtube_url"
                                value="{{ old('youtube_url', $settings->youtube_url) }}"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit"
                        class="btn btn-success px-4">Update Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
