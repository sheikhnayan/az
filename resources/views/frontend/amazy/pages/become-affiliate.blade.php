@extends('frontend.amazy.layouts.app')

@section('title')
Become Affiliate
@endsection
@section('content')

<div class="container mt_30 mb_30 min-vh-50">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <p style="text-align: center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <form action="{{ route('apply-affiliate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Blood Group</label>
                        <input type="text" name="blood_group" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Whatsapp Number</label>
                        <input type="text" name="whatsapp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">NID Number</label>
                        <input type="text" name="nid_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">NID Front Image</label>
                        <input type="file" name="nid_front" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">NID Back Image</label>
                        <input type="file" name="nid_back" class="form-control">
                    </div>

                    <h4 class="mt-4">Payment</h4>
                    <h4 class="mt-4">Payment Amount is {{ $amount }}</h4>

                    <div class="form-group mt-4">
                        <label>Payment way</label>
                        <select id="payment_method" class="form-control">
                            <option value="null" selected disabled>Select</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                    </div>

                    <input type="hidden" name="amount" value="{{ $amount }}">

                    <div class="offline mt-4" style="display: none;">
                        <div class="form-group">
                            <label for="">Payment Method</label>
                            <select name="payment_method" id="" class="form-control">
                                <option value="Bkash">Bkash</option>
                                <option value="Nagad">Nagad</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Account Number / Bank Name</label>
                            <input type="text" name="account_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Transaction Number</label>
                            <input type="text" name="transaction_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Screen Shot</label>
                            <input type="file" name="screen_shot" class="form-control" required>
                        </div>
                    </div>
                    <div class="online mt-4" style="display: none;">
                        <h5 class="text-danger">Sorry Currently Unavailable!</h5>
                    </div>

                    <button class="btn btn-success mt-4" type="submit">
                        Apply for Affiliate
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


