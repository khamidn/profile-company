@extends('layouts.pivot')
@section('title') Contact @endsection

@section('content')
<section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('pivot/img/slider-1.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">Contact Us</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5 class="text-uppercase mb-3">Address</h5>
            <p class="mb-5">{{$contact->alamat}}, <br> {{$contact->kota_kabupaten}} <br>{{$contact->provinsi}} {{$contact->kode_pos}}</p>
            
            <h5 class="text-uppercase mb-3">Email Us At</h5>
            <p class="mb-5">
              @if($contact->email1)
                <a href="mailto:{{$contact->email1}}">{{$contact->email1}}</a><br>
              @endif

              @if($contact->email2)
                <a href="mailto:{{$contact->email2}}">{{$contact->email2}}</a>
              @endif
            </p>
            
            <h5 class="text-uppercase mb-3">Call Us</h5>
            <p class="mb-5">
              Phone: (+62) @if($contact->phone) {{$contact->phone}} @endif <br> 
              Mobile: (+62) @if($contact->mobile) {{$contact->mobile}} @endif <br> 
              Fax: (+62) @if($contact->fax) {{$contact->fax}} @endif
            </p>
          </div>
        </div>
      </div>
    </section>
@endsection