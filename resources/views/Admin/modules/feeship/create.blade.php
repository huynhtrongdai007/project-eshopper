@extends('admin.master_layout')
@section('title','Tạo Phí Vận Chuyển')
@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.coupon.store') }}" method="POST">
                @csrf
                <div class="mb-3" class="form-group">
                  <label  class="form-label" for="province">Province Name</label>
                  <select name="province_name" id="province" class="form-control choose">
                    <option value="">--Choose--</option>
                    @foreach ($provinces as $item)
                    <option value="{{$item->code}}">{{$item->full_name}}</option>                        
                    @endforeach
                  </select>
                  @error('province_name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                 <div class="mb-3" class="form-group">
                  <label  class="form-label" for="district_name">Province Name</label>
                  <select name="district_name" id="district" class="form-control choose">
         
                  </select>
                  @error('district_name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                 <div class="mb-3" class="form-group">
                  <label  class="form-label" for="ward_name">Ward Name</label>
                  <select name="ward_name" id="ward" class="form-control">
            
                  </select>
                  @error('ward_name')
                      <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <button type="submit" id="btn-add-feeship" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
@endsection
