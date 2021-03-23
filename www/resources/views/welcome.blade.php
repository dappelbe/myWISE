@extends('layouts.unsecured')
@section('content')
    <main>
        <section class="section section-sm pt-0">
            <div class="container">
                <div class="row justify-content-center mb-5 mb-lg-6">
                    <div class="col-12 text-center">
                        <h3>LIVE Systems</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mb-5">
                        <a href="https://kadoorie.octru.ox.ac.uk/WISEIntervention/moodle/login/index.php" class="page-preview page-preview-lg scale-up-hover-2">
                            <img class="shadow-lg rounded scale" src="{{url('/assets/img/wise_logo-half.png')}}" alt="Access E-Learning System">
                            <div class="text-center show-on-hover">
                                <h6 class="m-0 text-center text-white">Access the WISE Programme<i class="fas fa-external-link-alt ml-2"></i></h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-5">
                        <a href="{{url('/login')}}" class="page-preview page-preview-lg scale-up-hover-2">
                            <img class="shadow-lg rounded scale" src="{{url('/assets/img/wise_diary_screen.png')}}" alt="My Journal System">
                            <div class="text-center show-on-hover">
                                <h6 class="m-0 text-center text-white">Access my Learning diary<i class="fas fa-external-link-alt ml-2"></i></h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-5">
                        <a href="https://redcap-cctr.octru.ox.ac.uk/" class="page-preview page-preview-lg scale-up-hover-2">
                            <img class="shadow-lg rounded scale" src="{{url('/assets/img/redcap_login.png')}}" alt="Enrol a participant preview">
                            <div class="text-center show-on-hover">
                                <h6 class="m-0 text-center text-white">Enrol a participant in WISE, STUDY Team ONLY<i class="fas fa-external-link-alt ml-2"></i></h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 mb-5">
                        <a href="https://sims-wise.octru.ox.ac.uk/" class="page-preview page-preview-lg scale-up-hover-2">
                            <img class="shadow-lg rounded scale" src="{{url('/assets/img/redcap_login.png')}}" alt="Access the Study Management System">
                            <div class="text-center show-on-hover">
                                <h6 class="m-0 text-center text-white">Access the Study Management System<i class="fas fa-external-link-alt ml-2"></i></h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <h3>Test/Training Systems</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mb-5">
                        <a href="https://redcap-cctr.octru.ox.ac.uk/" class="page-preview page-preview-lg scale-up-hover-2">
                            <img class="shadow-lg rounded scale" src="{{url('/assets/img/redcap_login.png')}}" alt="Enrol a participant preview">
                            <div class="text-center show-on-hover">
                                <h6 class="m-0 text-center text-white">Enrol a participant in WISE, STUDY Team ONLY<i class="fas fa-external-link-alt ml-2"></i></h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-sm pt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-3 text-center mb-4">
                        <div class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle icon-secondary mb-4">
                            <span class="fas fa-envelope-open"></span>
                        </div>
                        <h3 class="font-weight-bolder">Contact Us</h3>
                        <div class="text-muted">Email</div><a class="lead font-weight-bold" href="mailto:wise@ndorms.ox.ac.uk">wise@ndorms.ox.ac.uk</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('pagejs')
@endsection
