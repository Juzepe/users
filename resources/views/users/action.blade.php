<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary btn-sm mr-4" href="{{url("users/$user->id/edit")}}">Edit</a>
    </div>

    <div class="col-md-6">
        <form method="POST" action="users/{{$user->id}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <div class="form-group">
                <input type="submit" class="btn btn-danger btn-sm delete-user" value="Delete">
            </div>
        </form>
    </div>
</div>
