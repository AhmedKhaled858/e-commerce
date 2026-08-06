@extends('admin.maindesign')

@section('content')
    {{-- <pre>
{{ dd($countries) }}
</pre> --}}
    <style>
        .card {
            border: none;
            border-radius: 12px;
        }

        .card-header {
            background: #2f343c;
            color: #fff;
            border-bottom: none;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
        }

        .card-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control,
        .custom-select {
            height: 46px;
            border-radius: 8px;
        }

        .btn {
            border-radius: 8px;
        }

        .rounded-circle {
            border: 4px solid #444;
        }

        .text-muted {
            font-size: 14px;
        }
    </style>
    <div class="container-fluid">

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            {{-- @method('PATCH') --}}

            <div class="row">

                <!-- Profile Card -->
                <div class="col-lg-3">

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-body text-center">

                            <img src="{{ $user->profile->image ? asset('storage/' . $user->profile->image) : asset('assets/images/default-user.png') }}"
                                class="rounded-circle mb-3" width="140" height="140" style="object-fit:cover;">

                            <h4 class="mb-1">
                                {{ $user->profile->first_name }}
                                {{ $user->profile->last_name }}
                            </h4>

                            <p class="text-muted">
                                {{ $user->email }}
                            </p>

                            <div class="form-group mt-4">
                                <label>Profile Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Right Side -->
                <div class="col-lg-9">

                    <!-- Personal Information -->

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fa fa-user mr-2"></i>
                                Personal Information
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-form.label for="first_name">First Name</x-form.label>
                                        <x-form.input id="first_name" name="first_name" class="form-control" type="text"
                                            :value="$user->profile->first_name" placeholder="Enter first name" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-form.label for="last_name">Last Name</x-form.label>
                                        <x-form.input id="last_name" name="last_name" class="form-control" type="text"
                                            :value="$user->profile->last_name" placeholder="Enter last name" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-form.label for="phone_number">Phone Number</x-form.label>
                                        <x-form.input id="phone_number" name="phone_number" class="form-control"
                                            type="text" :value="$user->profile->phone_number" placeholder="Enter phone number" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-form.label for="birth_date">Birth Date</x-form.label>
                                        <x-form.input id="birth_date" name="birth_date" class="form-control" type="date"
                                            :value="$user->profile->birth_date" placeholder="Enter birth date" />
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <x-form.label for="gender">
                                            Gender
                                        </x-form.label>

                                        <x-form.radio id="gender" name="gender" :options="[
                                            'male' => 'Male',
                                            'female' => 'Female',
                                        ]" :selected="$user->profile->gender" />

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Address Information -->

                    <div class="card shadow-sm border-0 mb-4">

                        <div class="card-header">

                            <h5 class="mb-0">
                                <i class="fa fa-map-marker-alt mr-2"></i>
                                Address Information
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-form.label for="street_address">
                                            Street Address
                                        </x-form.label>

                                        <x-form.input id="street_address" name="street_address" class="form-control"
                                            type="text" :value="$user->profile->street_address" placeholder="Enter street address" />
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <x-form.label for="city">
                                            City
                                        </x-form.label>

                                        <x-form.input id="city" name="city" class="form-control" type="text"
                                            :value="$user->profile->city" placeholder="Enter city" />

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <x-form.label for="state">
                                            State
                                        </x-form.label>

                                        <x-form.input id="state" name="state" class="form-control" type="text"
                                            :value="$user->profile->state" placeholder="Enter state" />

                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <x-form.label for="state">
                                            Postal Code
                                        </x-form.label>

                                        <x-form.input id="postal_code" name="postal_code" class="form-control" type="text"
                                            :value="$user->profile->postal_code" placeholder="Enter postal code" />

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <x-form.label for="country">
                                            Country
                                        </x-form.label>

                                        <x-form.select id="country" name="country" class="form-control" :options="$countries"
                                            :value="$user->profile->country" placeholder="Select Country" />

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <x-form.label for="locale">
                                            Language
                                        </x-form.label>

                                        <x-form.select id="locale" name="locale" class="form-control" :options="$locales"
                                            :value="$user->profile->locale" placeholder="Select Language" />

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Buttons -->

                    <div class="text-right mb-5">

                        <a href="{{route('dashboard')}}" class="btn btn-outline-secondary mr-2">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-5">
                            <i class="fa fa-save mr-1"></i>
                            Save Changes
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection
