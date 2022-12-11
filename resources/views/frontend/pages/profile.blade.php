@extends('frontend.layouts.master')

@section('title', 'Profile')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Pofile</div>
                    <div class="card-body">
                        <form action="{{ route('profileupdate') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                  <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" id="name">
                                </div>
                              </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" id="email">
                                </div>
                              </div>
                            <div class="mb-3 row">
                                <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                <div class="col-sm-10">
                                  <input type="text" name="mobile" value="{{ auth()->user()->mobile }}" class="form-control" id="mobile">
                                </div>
                              </div>
                            <div class="mb-3 row">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                  <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ auth()->user()->address }}</textarea>
                                </div>
                              </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="password" name="password">
                                </div>
                              </div>
                              <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                              <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
