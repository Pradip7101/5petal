@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Manage Home page</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li class="active">Manage Home page</li>
                </ul>
            </div>
        </div>

        <section class="dashboard_box users_edit">
            <div class="border-box profile_edit">

                @if(session('success'))
                    <div id="success-alert">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <form role="form"
                      action="{{ route('admin.manage-home-pages.update') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body card-padding">

                        <!-- Below Banner Description -->
                        <div class="sale-background">
                            <div class="form-group">
                                <label for="below_banner_description" class="form-label">
                                    Below Banner Description
                                </label>
                                <textarea name="below_banner_description"
                                          class="form-control @error('below_banner_description') is-invalid @enderror"
                                          id="below_banner_description">{{ old('below_banner_description', $manageHomePage->below_banner_description) }}</textarea>

                                @error('below_banner_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Home Page Video -->
                        <div class="sale-background">
                            <div class="form-group">
                                <label for="home_video" class="form-label">
                                    Home Page Video
                                </label>

                                <input type="file"
                                       name="home_video"
                                       id="home_video"
                                       class="form-control @error('home_video') is-invalid @enderror"
                                       accept="video/mp4,video/webm,video/ogg">

                                @error('home_video')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                                @if(!empty($manageHomePage->home_video))
                                    <div class="mt-2">
                                        <video width="300" controls>
                                            <source src="{{ asset('admin_assets/uploads/home-videos/'.$manageHomePage->home_video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- Sale Section -->
                        <div class="sale-background">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Sale Section Sale Text Left
                                        </label>
                                        <input type="text"
                                               name="sale_section_sale_text_left"
                                               class="form-control @error('sale_section_sale_text_left') is-invalid @enderror"
                                               value="{{ old('sale_section_sale_text_left', $manageHomePage->sale_section_sale_text_left) }}">
                                        @error('sale_section_sale_text_left')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Sale Section Sale Text Right
                                        </label>
                                        <input type="text"
                                               name="sale_section_sale_text_right"
                                               class="form-control @error('sale_section_sale_text_right') is-invalid @enderror"
                                               value="{{ old('sale_section_sale_text_right', $manageHomePage->sale_section_sale_text_right) }}">
                                        @error('sale_section_sale_text_right')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Sale Section Sale Start
                                        </label>
                                        <input type="datetime-local"
                                               name="sale_section_sale_start"
                                               class="form-control @error('sale_section_sale_start') is-invalid @enderror"
                                               value="{{ old('sale_section_sale_start', $manageHomePage->sale_section_sale_start ? $manageHomePage->sale_section_sale_start->format('Y-m-d\TH:i') : '') }}">
                                        @error('sale_section_sale_start')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Sale Section Sale End
                                        </label>
                                        <input type="datetime-local"
                                               name="sale_section_sale_end"
                                               class="form-control @error('sale_section_sale_end') is-invalid @enderror"
                                               value="{{ old('sale_section_sale_end', $manageHomePage->sale_section_sale_end ? $manageHomePage->sale_section_sale_end->format('Y-m-d\TH:i') : '') }}">
                                        @error('sale_section_sale_end')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="submit_btn">
                                Update Product
                            </button>
                            <a href="{{ route('admin.manage-home-pages') }}" class="back_btn">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
