@extends('layouts.app')

@section('content')
    <div class="card-header">Edit user</div>

    <div class="card-body">
        <form action="{{url('users/' . $user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field("PUT") }}

            <div class="form-group">
                <label for="first_name">First name:</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                       placeholder="Enter first name" name="first_name" value="{{old("first_name", $user->first_name)}}">

                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last name:</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                       placeholder="Enter last name" name="last_name" value="{{old("last_name", $user->last_name)}}">

                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email"
                       name="email" value="{{old("email", $user->email)}}">

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror"
                       placeholder="Enter address" name="address" value="{{old("address", $user->address)}}">

                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone"
                       name="phone" value="{{old("phone", $user->phone)}}">

                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group custom-file mb-3 mt-2">
                <label class="custom-file-label" for="image">Update image</label>
                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image">

                @error('photo')
                <div class="invalid-feedback mb-3">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Enter password" name="password" value="{{old("password")}}">

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Password confirmation:</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="Enter password again" name="password_confirmation"
                       value="{{old("password_confirmation")}}">

                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Edit user</button>
        </form>
    </div>

    <div class="card-footer">
        <img src="{{asset("$user->image")}}" alt="image" style="max-height: 100px;">
    </div>
@endsection

@push('before_body')

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();

            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $(function () {
            $(".card-footer").load("https://mdbootstrap.com/mdb-addons/mdb-lightbox-ui.html");
        });
    </script>
@endpush
