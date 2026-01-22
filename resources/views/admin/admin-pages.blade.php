@extends('admin.layouts.app')
@section('title', 'Pages Management - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <h2>Pages Management</h2>
    </div>

    <div class="pages-list">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Page Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Home</td>
                        <td><a href="{{ route('admin.pages.home') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Services</td>
                        <td><a href="{{ route('admin.pages.services') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>About</td>
                        <td><a href="{{ route('admin.pages.about') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><a href="{{ route('admin.pages.location') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><a href="{{ route('admin.pages.contact') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Terms & Conditions</td>
                        <td><a href="{{ route('admin.pages.terms') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Privacy Policy</td>
                        <td><a href="{{ route('admin.pages.privacy') }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection