@extends('admin.layouts.app')

@section('title', 'Dashboard - EMX Auto Repair Admin')

@section('content')
    <div class="section-header">
        <h2>Dashboard</h2>
        <p>Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Total Users</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-success">
                <i class="fas fa-wrench"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_services'] }}</h3>
                <p>Services Offered</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-info">
                <i class="fas fa-images"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_media'] }}</h3>
                <p>Media Items</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-warning">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3>{{ number_format($stats['average_rating'], 1) }}</h3>
                <p>Average Rating</p>
            </div>
        </div>
    </div>

    <div class="dashboard-tables" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="table-container">
            <div
                style="padding: 20px; border-bottom: 1px solid var(--color-border-subtle); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0;">Latest Reviews</h3>
                <a href="{{ route('admin.reviews') }}" class="btn btn-sm btn-text">View All</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestReviews as $review)
                        <tr>
                            <td>{{ $review->user->name ?? 'Unknown' }}</td>
                            <td>
                                <span class="review-on">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->stars ? '' : 'review-off' }}"
                                            style="font-size: 0.8rem;"></i>
                                    @endfor
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.reviews') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No reviews yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <div
                style="padding: 20px; border-bottom: 1px solid var(--color-border-subtle); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0;">Recent Services</h3>
                <a href="{{ route('admin.services') }}" class="btn btn-sm btn-text">Manage</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allServices as $service)
                        <tr>
                            <td>{{ $service->title }}</td>
                            <td class="text-muted" style="font-size: 0.85rem;">{{ $service->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.services') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No services added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection