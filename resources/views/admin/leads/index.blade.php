@extends('admin.admin_layouts.admin_app')
@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Leads (User Informations)</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li class="active">User Informations</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box users_edit">
            <div class="">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <!-- <div class="border-box">
                        <div class="card-header">
                            <a href="{{ route('admin.users.create') }}" class="submit_btn">Add User</a>
                        </div>
                    </div> -->
                    <table id="leadsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('#leadsTable').DataTable();
    });
</script>
@endpush
@endsection
