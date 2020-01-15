@extends('layouts.app')

@section('content')
    <div class="card-header">List of users</div>

    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <table id="users" class="table table-bordered">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Edit or delete</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="card-footer">
        <a class="btn btn-primary" href="{{url('users/create')}}">Add user</a>
    </div>
@endsection

@push('before_body')

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script>
        $('#users').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "{{ url('users') }}",
                method: 'GET',
            },
            "columns": [
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action'},
            ]
        });

        $("#users").on("click",".delete-user", function(e) {
            e.preventDefault();

            if (confirm("Are you sure?")) $(e.target).closest("form").submit();
        });
    </script>

@endpush
