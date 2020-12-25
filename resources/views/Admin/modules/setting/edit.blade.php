@extends('admin.master_layout')
@section('title','Tạo Setting')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Setting</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.setting.update',['id'=>$setting->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Config Key</label>
                  <input type="text" name="config_key" value="{{$setting->config_key}}" class="form-control @error('config_key') is-invalid @enderror" placeholder="Enter Config Key">
                  @error('config_key')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Config Value</label>
                  <textarea name="config_value"  class="form-control @error('config_value') is-invalid @enderror" placeholder="Enter Config Value">
                    {{$setting->config_value}}
                  </textarea>
                  @error('config_value')
                     <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
