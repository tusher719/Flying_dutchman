@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>We Have Sent a Verification email, click the button and verify your account!</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/email/verification-notification') }}" method="post">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Email Address</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter email....">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Resend</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
