@extends('front.layout.front')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>User Dashboard</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="true"><i class="fas fa-money-bill me-2"></i>Orders</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false"><i class="fas fa-comment me-2"></i>Reviews</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile-tab-pane" type="button" role="tab" aria-controls="edit-profile-tab-pane" aria-selected="false"><i class="fas fa-user-edit me-2"></i>Edit Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password-tab-pane" type="button" role="tab" aria-controls="change-password-tab-pane" aria-selected="false"><i class="fas fa-asterisk me-2"></i>Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">
                                <h2>Orders</h2>
                            </div>
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                                <h2>Reviews</h2>
                            </div>
                            <div class="tab-pane fade" id="edit-profile-tab-pane" role="tabpanel" aria-labelledby="edit-profile-tab" tabindex="0">
                                @include('front.user.edit-profile')
                            </div>
                            <div class="tab-pane fade" id="change-password-tab-pane" role="tabpanel" aria-labelledby="change-password-tab" tabindex="0">
                                @include('front.user.change-password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content -->
    </div>
@endsection
