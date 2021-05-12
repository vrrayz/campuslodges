@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <br/>
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="py-3 mb-3" style="border-bottom: 2px solid #ddd;"> <span class="text-site">Contact</span> us</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center text-secondary">
                            Reach out to us by filling the form below
                        </h5>
                        <div class="col-md-6 mb-3 mx-auto">
                            <form>
                                <div class="form-group mb-3">
                                    <label>
                                        Name
                                    </label>
                                    <input type="text" placeholder="Your Full Name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>
                                        Phone No:
                                    </label>
                                    <input type="text" placeholder="Phone Number" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>
                                        Email:
                                    </label>
                                    <input type="email" placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-center">
                                        Topic:
                                    </label>
                                    <input type="text" placeholder="Topic" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-center">
                                        Message:
                                    </label>
                                    <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="What would you like to tell us"></textarea>
                                </div>
                                <button class="btn btn-outline-success btn-lg btn-block">Send Message</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-center mx-auto">
                            <h4>OR</h4>
                            You can send an email to xoxoxoxo@email.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection