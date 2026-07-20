@extends('admin.maindesign')

@section('createcategory')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.storeCategory') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include("admin._categoryform",['button_label'=>'Create','is_modal'=>false])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src ="{{ asset('front_end/js/timeout.js') }}"></script>
        
@endsection
