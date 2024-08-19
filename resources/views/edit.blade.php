@extends('layout.app')
@section('content')
<div class="container w-50 mx-auto m-5 bg-white rounded p-4">
    <h1 class="text-center text-success" style="font-weight: bold;">Create Contact</h1>
    <div class="row">
        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $contact->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" readonly name="email" class="form-control" id="email" value="{{ $contact->email }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ $contact->phone }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ $contact->address }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/contacts" class="btn btn-secondary">Back to home</a>
        </form>
    </div>
</div>
@endsection
