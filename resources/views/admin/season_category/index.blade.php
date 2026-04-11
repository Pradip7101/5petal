@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Season Category Management</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li class="active">Season Category Management</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box users_edit">
            <div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="border-box">
                        <div class="card-header">
                            <a href="{{ route('admin.season-category.create') }}" class="submit_btn">Add Season Category</a>
                        </div>
                    </div>
                    <table id="seasonCategoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Banner Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seasonCategory as $seasonCat)
                                <tr>
                                    <td>
                                        <div class="table_thambnail">
                                            @if($seasonCat->image && file_exists(public_path('admin_assets/uploads/' . $seasonCat->image)))
                                                <img src="{{ asset('admin_assets/uploads/' . $seasonCat->image) }}" alt="Image" class="img-thumbnail" style="width: 50px;">
                                            @else
                                                <img src="{{ asset('admin_assets/images/default.png') }}" alt="Default Image" class="img-thumbnail" style="width: 50px;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table_thambnail">
                                            @if($seasonCat->banner_image && file_exists(public_path('admin_assets/uploads/' . $seasonCat->banner_image)))
                                                <img src="{{ asset('admin_assets/uploads/' . $seasonCat->banner_image) }}" alt="Image" class="img-thumbnail" style="width: 50px;">
                                            @else
                                                <img src="{{ asset('admin_assets/images/default.png') }}" alt="Default Image" class="img-thumbnail" style="width: 50px;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <p class="linedots">
                                            {{ $seasonCat->title }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="linedots">
                                            {{ $seasonCat->slug }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="linedots">
                                            {!! $seasonCat->description !!}
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.season-category.edit', $seasonCat->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="14" height="14"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.season-category.destroy', $seasonCat->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this season category?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
