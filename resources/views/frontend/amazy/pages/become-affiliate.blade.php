@extends('frontend.amazy.layouts.app')

@section('title')
Become Affiliate
@endsection
@section('content')

<div class="container mt_30 mb_30 min-vh-50">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <label for="">NID Number</label>
                    <input type="text" name="nid_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">NID Front Image</label>
                    <input type="file" name="nid_front" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">NID Back Image</label>
                    <input type="file" name="nid_back" class="form-control" required>
                </div>

                <h4>Payment</h4>

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
                    <input type="file" name="account_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Transaction Number</label>
                    <input type="file" name="transaction_number" class="form-control" required>
                </div>
                <button class="btn btn-success mt-4" type="submit">
                    Apply for Affiliate
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
