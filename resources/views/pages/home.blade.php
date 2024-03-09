@extends('layouts.app')

@section('css')
    <style>
        #main {
            margin-top: 0;
            margin-bottom: 0;
            padding: 0;
            transition: all 0.3s;
            overflow: hidden;
        }

        #main img {
            max-width: 65%;
            height: auto;
            object-fit: contain;
            max-width: 1024px;
            opacity: 10%;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">
        <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <img src="{{ asset('./img/welcome.png') }}" alt="world">
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
