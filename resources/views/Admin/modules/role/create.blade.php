@extends('admin.master_layout')
@section('title','Tạo Role')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Role</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name</label>
                  <input type="text" name="name" class="form-control @error('config_key') is-invalid @enderror" placeholder="Enter Name">
                  @error('config_key')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Display Name</label>
                  <textarea name="display_name" role="10" rows="10" class="form-control @error('config_value') is-invalid @enderror" placeholder="Enter Display Name"></textarea>
                  @error('config_value')
                     <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

             <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header alert alert-success">
                            <label for="">
                                <input type="checkbox">
                                Module San pham
                            </label>
                        </div>
                      
                        <div class="card-body">
                           <div class="row">
                               @for ($i = 0; $i < 4; $i++)
                               <div class="col-md-3">
                                    <label for="">
                                        <input type="checkbox">
                                        Thêm sản phẩm
                                    </label>
                                 </div>
                            
                               @endfor
                          
                           
                           </div>
                          
                        </div>
                    </div>
    
                </div>
             </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
