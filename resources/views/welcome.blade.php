@extends('layouts.app')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row g-10">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="card-xl-stretch me-md-6">
                                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
                                        style="background-image:url('/metronic8/demo1/assets/media/stock/600x400/img-73.jpg')"
                                        data-fslightbox="lightbox-video-tutorials"
                                        href="{{ route('home.show', $post->id) }}">
                                        <img src="@if($post->thumbnail){{ asset($post->thumbnail) }} @else https://via.placeholder.com/350x150@endif @endif" class="position-absolute top-50 start-50 translate-middle" alt="">
                                    </a>
                                    <div class="m-0">
                                        <a href="{{ route('home.show', $post->id) }}" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">{{ trim_string($post->text, 50) }}</a>

                                        <div class="fw-bold fs-5 text-gray-600 text-dark my-4">{{ trim_string($post->description, 300) }}</div>

                                        <div class="fs-6 fw-bolder">
                                            <a href="{{ route('home.show', $post->id) }}"
                                                class="text-gray-700 text-hover-primary">{{ $post->Auther->name }}</a>
                                            <span class="text-muted">on {{ $post->created_at }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="card-xl-stretch me-md-6">
                                    <h3>No Posts are found</h3>
                                </div>
                            </div>
                        @endforelse
                        <!--end::Col-->
                    </div>
                    <div class="separator separator-dashed border-gray-300 mb-9 mt-5"></div>
                    {{-- <div class="">
                        <!--begin::Section-->
                        <div class="m-0">
                            <!--begin::Content-->
                            <div class="d-flex flex-stack">
                                <!--begin::Title-->
                                <h3 class="text-dark">Latest Instagram Posts</h3>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <a href="#" class="fs-6 fw-bold link-primary">View Instagram</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed border-gray-300 mb-9 mt-5"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Row-->
                        <div class="row g-10 row-cols-2 row-cols-lg-5">
                            <!--begin::Col-->
                            <div class="col">
                                <!--begin::Overlay-->
                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                                    href="https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg')">
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Action-->
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col">
                                <!--begin::Overlay-->
                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                                    href="https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg')">
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Action-->
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                            </div>
                            <div class="col">
                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                                    href="https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg')">
                                    </div>
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                                    href="https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg')">
                                    </div>
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                                    href="https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/stock/900x600/16.jpg')">
                                    </div>
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
