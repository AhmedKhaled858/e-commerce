@extends('admin.maindesign')

@section('addproduct')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Product</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            @include('admin._productform',['button_label'=>'Create','is_modal'=>false])
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('front_end/js/timeout.js') }}"></script>
    
@endsection
