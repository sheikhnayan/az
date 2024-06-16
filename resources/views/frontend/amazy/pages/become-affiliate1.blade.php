@extends('frontend.amazy.layouts.app')

@section('title')
Become Affiliate
@endsection
@section('content')
<style>

.row {
  height: 100%;
  align-items: center;
}

#pricing {
  height: 100%;
  padding: 100px;
  text-align: center;
}

.card {
  border: 1px solid black;
}

.card-header {
  color: white;
  background-color: black;
}

.pricing-column {
  padding: 3% 2%;
}

.btn-dark {
  background-color: black;
}

.btn-dark:hover {
  background-color: #343a40;
}

.card-header h3{
    color: #fff !important;
}
</style>

<div class="container mt_30 mb_30 min-vh-50">
    <div class="row justify-content-center">
        <section id="pricing">

            <div class="row">
              <div class="pricing-column col-lg-4 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3>Basic</h3>
                  </div>
                  <div class="card-body">
                    <h2>2000 BDT</h2>
                    <p>No Listing</p>
                    <p>5 Matches Per Day</p>
                    <p>10 Messages Per Day</p>
                    <p>Unlimited App Usage</p>
                    <a href="{{ route('bacome-affiliate-second',[2000]) }}" class="btn btn-lg btn-block btn-dark mt-4" type="button">Apply</a>
                  </div>
                </div>
              </div>

              <div class="pricing-column col-lg-4 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3>Premium</h3>
                  </div>
                  <div class="card-body">
                    <h2>20,000 BDT</h2>
                    <p>No Listing</p>
                    <p>Unlimited Matches</p>
                    <p>Unlimited Messages</p>
                    <p>Unlimited App Usage</p>
                    <a href="{{ route('bacome-affiliate-second',[20000]) }}" class="btn btn-lg btn-block btn-dark mt-4" type="button">Apply</a>
                  </div>
                </div>
              </div>

              <div class="pricing-column col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Business </h3>
                  </div>
                  <div class="card-body">
                    <h2>200,000 BDT</h2>
                    <p>Pirority Listing</p>
                    <p>Unlimited Matches</p>
                    <p>Unlimited Messages</p>
                    <p>Unlimited App Usage</p>
                    <a href="{{ route('bacome-affiliate-second',[200000]) }}" class="btn btn-lg btn-block btn-dark mt-4" type="button">Apply</a>
                  </div>
                </div>
              </div>

            </div>

          </section>
    </div>
</div>

@endsection
