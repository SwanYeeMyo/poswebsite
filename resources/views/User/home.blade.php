@extends('layouts.user.master')
@section('content')
<div class="container-fluid mb-4">
    <div class="row ">

        <!-- Background image -->
        <div class="p-5 text-center bg-image" style="
              background-image: url('https://i0.wp.com/sporked.com/wp-content/uploads/2023/06/RANKING-UPDATE_DORITOS_HEADER.jpg?fit=1920%2C1080&ssl=1');
              height: 400px;
            ">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 class="mb-3">Feeling Hungry</h1>
                        <h4 class="mb-3">Remember Family Marks your family best fiend</h4>
                        <a class="btn btn-outline-light btn-lg" href="{{route('user#home')}}" role="button">Explore</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Background image -->

    </div>
</div>
<div class="container mb-5  ">
    <div class="row ">
        <div class="col-lg-6  my-md-5 my-0">
            <div class="card">
                <img src="{{ asset('Image/crop (2).webp') }}" class="rounded" alt="">
            </div>
        </div>
        <div class="col-lg-6">
            <h3>Populdar Snack Today</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, accusamus.</p>
            <div class="row">
                @foreach ($product as $p )
                <div class="col-lg-4 col-md-4 col-12 g-3">
                    <div class="card h-100 rounded-6">
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <img src="{{ asset('storage/' . $p->image) }}" class="card-img-top" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h6 class=" text-secondary card-title">{{$p->name}}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-warning mt-3">
            Snacks
        </button>
    </div>
</div>
<div class="container">
    <div class="row   ">
        @foreach ($products as $p )
        <div class="col-lg-3 col-md-4 col-12 g-4">
            <div class="card rounded text-black">
                <img src="{{ asset('storage/' . $p->image) }}" class="card-img-top" alt="Apple Computer" />
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="card-title">Believing is seeing</h5>
                        <p class="text-muted mb-4">{{$p->name}}</p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold"><i class="mx-1 fa-solid fa-comment-dollar"></i></span><span
                                class="text-dark fs-6 ">{{$p->price}}
                                Kyats</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>
                                <p><i class="mx-1 fa-solid fa-truck"></i> </p>
                            </span><span class="text-dark">3000 Kyats</span>
                        </div>
                        <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <span class="fw-bold">Total</span><span class="">{{$p->price
                                + 3000}} Kyats </span>
                        </div>
                        <div class="text-center my-2">
                            <form action="{{route('user#view')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$p->id}}">
                                <button class="btn btn-dark">View Item</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="card h-100 p-2  ">
                <div class="bg-image hover-zoom">
                    <img src="{{ asset('storage/' . $p->image) }}" class="img-fluid rounded" alt="">
                </div>
                <div class="card-body">
                    <h5 class="fw-bold my-1">{{$p->name}}</h5>
                    <h6>{{$p->price}} Kyats</h6>
                </div>
                <div class="p-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p><i class="mx-1 fa-solid fa-truck"></i>3000 Kyats</p>
                        </div>
                        <button type="button" class="btn btn-outline-dark">View Item</button>
                    </div>
                </div>
            </div> --}}
        </div>
        @endforeach
    </div>
</div>
<div class="text-center my-lg-5 my-md-5 my-3 ">
    <a href="{{route('user#products')}}" class="btn btn-dark">
        View Snack
    </a>
</div>

<div class="mt-5 mb-5">
    <!-- Background image -->
    <div class="p-5 text-center bg-image rounded" style="
          background-image: url('https://hips.hearstapps.com/hmg-prod/images/snack-awards-index-6491dfdc76bbe.png?crop=0.889xw:1.00xh;0.0561xw,0&resize=2048:*');
          height: 400px;
        ">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h3 class="mb-3">Get Your Promo Code</h3>
                    <h4 class="mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita necessitatibus
                        itaque error sint blanditiis ut, laborum ipsum doloribus illum sed.</h4>
                    <a class="btn btn-warning btn-lg" href="#!" role="button">Register Button</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
</div>
<section class="gradient-custom bg-primary">
    <div class="container my-5 py-5">
        <h5 class="text-center text-light">
            Testimonials
        </h5>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="text-center mb-4 pb-2">
                    <i class="fas fa-quote-left fa-3x text-white"></i>
                </div>

                <div class="card">
                    <div class="card-body px-4 py-5">
                        <!-- Carousel wrapper -->
                        <div id="carouselDarkVariant" class="carousel slide carousel-dark" data-mdb-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-indicators mb-0">
                                <button data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="0" class="active"
                                    aria-current="true" aria-label="Slide 1"></button>
                                <button data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="1"
                                    aria-label="Slide 1"></button>
                                <button data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="2"
                                    aria-label="Slide 1"></button>
                            </div>

                            <!-- Inner -->
                            <div class="carousel-inner pb-5">
                                <!-- Single item -->
                                <div class="carousel-item active">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-10 col-xl-8">
                                            <div class="row">
                                                <div class="col-lg-4 d-flex justify-content-center">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"
                                                        class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="woman avatar"
                                                        width="150" height="150" />
                                                </div>
                                                <div
                                                    class="col-9 col-md-9 col-lg-7 col-xl-8 text-center text-lg-start mx-auto mx-lg-0">
                                                    <h4 class="mb-4">Maria Smantha - Web Developer</h4>
                                                    <p class="mb-0 pb-3">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A
                                                        aliquam amet animi blanditiis consequatur debitis dicta
                                                        distinctio, enim error eum iste libero modi nam natus
                                                        perferendis possimus quasi sint sit tempora voluptatem. Est,
                                                        exercitationem id ipsa ipsum laboriosam perferendis.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single item -->
                                <div class="carousel-item">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-10 col-xl-8">
                                            <div class="row">
                                                <div class="col-lg-4 d-flex justify-content-center">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"
                                                        class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="woman avatar"
                                                        width="150" height="150" />
                                                </div>
                                                <div
                                                    class="col-9 col-md-9 col-lg-7 col-xl-8 text-center text-lg-start mx-auto mx-lg-0">
                                                    <h4 class="mb-4">Lisa Cudrow - Graphic Designer</h4>
                                                    <p class="mb-0 pb-3">
                                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                        accusantium doloremque laudantium, totam rem aperiam, eaque
                                                        ipsa quae ab illo inventore veritatis et quasi architecto
                                                        beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                                                        quia voluptas sit aspernatur.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single item -->
                                <div class="carousel-item">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-10 col-xl-8">
                                            <div class="row">
                                                <div class="col-lg-4 d-flex justify-content-center">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(9).webp"
                                                        class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="woman avatar"
                                                        width="150" height="150" />
                                                </div>
                                                <div
                                                    class="col-9 col-md-9 col-lg-7 col-xl-8 text-center text-lg-start mx-auto mx-lg-0">
                                                    <h4 class="mb-4">John Smith - Marketing Specialist</h4>
                                                    <p class="mb-0 pb-3">
                                                        At vero eos et accusamus et iusto odio dignissimos qui
                                                        blanditiis praesentium voluptatum deleniti atque corrupti quos
                                                        dolores et quas molestias excepturi sint occaecati cupiditate
                                                        non provident, similique sunt in culpa qui officia mollitia
                                                        animi id laborum et dolorum fuga.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Inner -->

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselDarkVariant"
                                data-mdb-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-mdb-target="#carouselDarkVariant"
                                data-mdb-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Carousel wrapper -->
                    </div>
                </div>

                <div class="text-center mt-4 pt-2">
                    <i class="fas fa-quote-right fa-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
