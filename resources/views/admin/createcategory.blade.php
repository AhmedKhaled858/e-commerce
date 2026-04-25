@extends('admin.maindesign')

@section('createcategory')
    @if (session('success'))
        <div class="alert success">
            <i class="fa fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert error">
            <i class="fa fa-times-circle"></i>
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.storeCategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="category_name" id="category_name"
                                    placeholder="Enter Category Name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            const alert = document.querySelector('.alert');

            if (alert) {
                alert.style.transition = "0.5s";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-10px)";

                setTimeout(() => {
                    alert.style.display = "none";
                }, 500);
            }

        }, 15000);
    </script>
@endsection
