@extends('admin.maindesign')

@section('review')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="text-light mb-0">
                Product Reviews
            </h3>

            <p class="text-secondary mb-0">
                Manage customer reviews and moderation
            </p>
        </div>

        <div class="review-count-box">

            <i class="fa fa-comments"></i>

            {{ $reviews->count() }} Reviews

        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="review-card">

        <div class="table-responsive">

            <table class="table review-table align-middle mb-0">

                <thead>

                    <tr class="text-secondary">

                        <th>#</th>

                        <th>User</th>

                        <th>Product</th>

                        <th>Review</th>

                        <th>Rating</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($reviews as $review)

                        <tr>

                            {{-- ID --}}
                            <td class="text-info fw-bold">
                                #{{ $review->id }}
                            </td>

                            {{-- USER --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $review->user->name ?? 'Unknown User' }}
                                </div>

                                <small class="text-secondary">
                                    {{ $review->user->email ?? '' }}
                                </small>

                            </td>

                            {{-- PRODUCT --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    <img src="{{ asset('storage/' . $review->product->product_image) }}"
                                         class="product-image">

                                    <div class="ms-2">

                                        {{ $review->product->title ?? 'Deleted Product' }}

                                    </div>

                                </div>

                            </td>

                            {{-- REVIEW --}}
                            <td style="max-width:300px;">

                                <div class="review-box">

                                    {{ $review->review }}

                                </div>

                            </td>

                            {{-- RATING --}}
                            <td>

                                @for($i = 1; $i <= 5; $i++)

                                    @if($i <= $review->rating)

                                        <i class="fa fa-star text-warning"></i>

                                    @else

                                        <i class="fa fa-star text-secondary"></i>

                                    @endif

                                @endfor

                            </td>

                            {{-- STATUS --}}
                            <td>

                                <form id="form-{{ $review->id }}"
                                      action="{{ route('admin.review.status', $review->id) }}"
                                      method="POST">

                                    @csrf
                                    {{-- @method('PUT') --}}

                                    {{-- Badge --}}
                                    <span class="status-badge status-{{ $review->status }}">

                                        {{ ucfirst($review->status) }}

                                    </span>

                                    {{-- Select --}}
                                    <select name="status"
                                            class="form-select form-select-sm mt-2 status-select d-none">

                                        <option value="pending"
                                            {{ $review->status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>

                                        <option value="approved"
                                            {{ $review->status == 'approved' ? 'selected' : '' }}>
                                            Approved
                                        </option>

                                        <option value="rejected"
                                            {{ $review->status == 'rejected' ? 'selected' : '' }}>
                                            Rejected
                                        </option>

                                    </select>

                                </form>

                            </td>

                            {{-- DATE --}}
                            <td class="text-secondary">

                                {{ $review->created_at->format('Y-m-d') }}

                            </td>

                            {{-- ACTIONS --}}
                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-warning btn-icon edit-review-btn">

                                        <i class="fa fa-edit"></i>

                                    </button>

                                    {{-- SAVE --}}
                                    <button type="button"
                                            class="btn btn-sm btn-success btn-icon save-review-btn d-none"
                                            data-id="{{ $review->id }}">

                                        <i class="fa fa-check"></i>

                                    </button>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.review.delete', $review->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger btn-icon"
                                                onclick="return confirm('Delete this review?')">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <i class="fa fa-comments-o fa-3x text-secondary mb-3"></i>

                                <h5 class="text-light">
                                    No Reviews Found
                                </h5>

                                <p class="text-secondary">
                                    No customer reviews available.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>

</div>

{{-- SCRIPT --}}
<script>

    document.addEventListener('DOMContentLoaded', function() {

        // EDIT MODE
        document.querySelectorAll('.edit-review-btn').forEach(btn => {

            btn.addEventListener('click', function() {

                let row = this.closest('tr');

                row.querySelector('.status-badge').classList.add('d-none');

                row.querySelector('.status-select').classList.remove('d-none');

                row.querySelector('.save-review-btn').classList.remove('d-none');

                this.classList.add('d-none');

            });

        });

        // SAVE
        document.querySelectorAll('.save-review-btn').forEach(btn => {

            btn.addEventListener('click', function() {

                let id = this.dataset.id;

                let form = document.getElementById('form-' + id);

                if (form) form.submit();

            });

        });

    });

</script>

@endsection