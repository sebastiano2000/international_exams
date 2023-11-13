@extends('layouts.master')
<style>

@media (max-width: 991.98px) {
  .hero-header {
    padding: 3rem 0 !important;
  }
}
</style>
@section('content')
<div class=" bg-primary hero-header">

</div>


<div class="container-xxl ">
<div class="container  px-lg-5">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
    </div>
      
  <div id="pricing" class="pricing-tables">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h5 class="section-title text-secondary justify-content-center"><span></span>قائمه الأسعار <span></span></h5>
            <img src="{{ asset('assets/img/heading-line-dec.png')}}" alt="">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="pricing-item-regular">
            <span class="price"> 12 د ك</span>
            <h4>Standard Plan App</h4>
            <div class="icon">
              <img src="{{ asset('assets/img/pricing-table-01.png')}}" alt="">
            </div>
            <ul>
              <li>Lorem Ipsum Dolores</li>
              <li>20 TB of Storage</li>
              <li class="non-function">Life-time Support</li>
              <li class="non-function">Premium Add-Ons</li>
              <li class="non-function">Fastest Network</li>
              <li class="non-function">More Options</li>
            </ul>
            <div class="border-button">
              <a href="#">Purchase This Plan Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="pricing-item-pro">
            <span class="price"> 25 د ك</span>
            <h4>Business Plan App</h4>
            <div class="icon">
              <img src="{{ asset('assets/img/pricing-table-01.png')}}" alt="">
            </div>
            <ul>
              <li>Lorem Ipsum Dolores</li>
              <li>50 TB of Storage</li>
              <li>Life-time Support</li>
              <li>Premium Add-Ons</li>
              <li class="non-function">Fastest Network</li>
              <li class="non-function">More Options</li>
            </ul>
            <div class="border-button">
              <a href="#">Purchase This Plan Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="pricing-item-regular">
            <span class="price"> 66 د ك</span>
            <h4>Premium Plan App</h4>
            <div class="icon">
              <img src="{{ asset('assets/img/pricing-table-01.png')}}" alt="">
            </div>
            <ul>
              <li>Lorem Ipsum Dolores</li>
              <li>120 TB of Storage</li>
              <li>Life-time Support</li>
              <li>Premium Add-Ons</li>
              <li>Fastest Network</li>
              <li>More Options</li>
            </ul>
            <div class="border-button">
              <a href="#">Purchase This Plan Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
    </div>
</div>

@endsection
