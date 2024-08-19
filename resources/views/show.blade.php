@extends('layout.app')
@section('content')
<div class="container w-50 mx-auto m-5 bg-white rounded p-4">
    <h1 class="text-center text-success" style="font-weight: bold;">Create Contact</h1>
    <hr>
    <div>
        <h3>Name: {{ $contact->name }}</h3>
        <h3>Email: {{ $contact->email }}</h3>
        <h3>Phone: {{ $contact->phone }}</h3>
        <h3>Address: {{ $contact->address }}</h3>
    </div>
    <a class="btn btn-secondary" href="/contacts">Back to home</a>
</div>
@endsection
