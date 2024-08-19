@extends('layout.app')
@section('content')
<div class="container mx-auto m-5 bg-white rounded p-4">
    <h1 class="text-center text-success" style="font-weight: bold;">Contact Management</h1>
    <form action="">
        <div class="row">
            <div class="col col-4">
                <label class="form-label" for="sort_by">Sort By:</label>
                <select class="form-select" name="sort_by" id="sort_by" onchange="this.form.submit()">
                    <option value="name_asc" {{ request('sort_by') === 'name_asc' ? 'selected' : '' }}>Name Ascending</option>
                    <option value="name_desc" {{ request('sort_by') === 'name_desc' ? 'selected' : '' }}>Name Descending</option>
                    <option value="created_at_asc" {{ request('sort_by') === 'created_at_asc' ? 'selected' : '' }}>Created At Ascending</option>
                    <option value="created_at_desc" {{ request('sort_by') === 'created_at_desc' ? 'selected' : '' }}>Created At Descending</option>
                </select>
            </div>
            <div class="col col-6">
                <label class="form-label" for="search">Search:</label>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" id="search" name="search" value="" placeholder="search here...">
                    <button type="submit" class="btn btn-secondary float-end">Search</button>
                </div>
            </div>
            <div class="col col-2">
                <a href="{{ route('contacts.create') }}" class="btn btn-primary float-end" style="margin-top: 28px !important;">Add Contact</a>
            </div>
        </div>
    </form>
    <!-- table  -->
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Serial</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created_at</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->created_at}}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('contacts.show',$contact->id) }}" class="btn btn-sm btn-success text-white">Show</a>
                        <a href="{{ route('contacts.edit',$contact->id) }}" class="btn btn-sm btn-primary text-white">Edit</a>
                        <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger text-white">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>

      {{ $contacts->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
@endsection
