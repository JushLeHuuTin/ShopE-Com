<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Overflow Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="//img6.wsimg.com/ux-assets/favicon/favicon-96x96.png">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/reponsive.css') }}">
</head>

<body>
    <div class="wrapper">
        <div id="top"></div>
        <div class="header">
            <div class="header__msg-wrapper bg-dark d-flex">
                <div class="header__msg d-flex  align-items-center">
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    </ul>

                </div>
                <div class="header__msg d-flex  align-items-center">
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    <span class="outlined">
                        Giảm Giá Khai Trương
                    </span>
                    <span style="color: var(--primary-color)">
                        Giảm Giá Khai Trương
                    </span>
                    <span>
                        Giảm Giá Khai Trương
                    </span>
                    </ul>
                </div>
            </div>
            <div class="header__nav d-md-flex d-block align-items-center border-top border-bottom border-dark">
                <a href="{{ route('index') }}"
                    class="header__nav-logo-link d-md-block mt-md-0 mt-4 d-flex justify-content-center">
                    <img src="{{ asset('/images/logo_web.png') }}" alt="" class="header__nav-logo d-block mx-4"
                        style="width:174px;height:28px;object-fit:cover;">
                </a>
                <nav class="header__navbar flex-grow-1 border-start border-dark d-md-block d-none" style="height:68px">
                    <ul class="header__navbar-list d-flex align-items-center justify-content-center"
                        style="list-style: none; margin:0; height: 100%;">


                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Trang chủ
                            </a>
                        </li>
                  @php $count = 0; @endphp
                        @foreach ($categories as $item)
                        @if ($count++ <5)
                        
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold"
                                href="{{ route('category.show', $item->slug) }}">
                                {{ $item->name }}
                            </a>
                        </li>
                        @endif
                        @endforeach
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Giới thiệu
                            </a>
                        </li>
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Tin tức
                            </a>
                        </li>
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Liên hệ
                            </a>
                        </li>
                        {{-- <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Trang chủ
                            </a>
                            <!-- Home Content -->
                            <div class="select-home position-absolute bg-white">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <div id="introduct1" class="introduct">
                                                <h4 class="select-heading">COLLECTION LAYOUT</h4>
                                                <ul class="list-unstyled" style="font-size: 14px;">
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            1</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            2</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            3</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            4</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            5</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            6</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div id="introduct2" class="introduct">
                                                <h4 class="select-heading">HOME PAGE</h4>
                                                <ul class="list-unstyled" style="font-size: 14px;">
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            7</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            8</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            9</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            10</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            11</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout - Home
                                                            12</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div id="product1" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/Shoes_b57c8321-a4ae-4b26-81f0-d70c0d49c2d5.png') }}" alt="" class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">SHOES</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="product2" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/T-Shirt.png' )}}" alt=""
                                                        class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">T - SHIRT</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="product3" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/Sweater.png' )}}" alt=""
                                                        class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">SWEATER</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        {{-- <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold"
                                href="{{ route('category.filter'), $categories[0]->id_category }}">
                                Đồ bơi
                            </a>
                            <!-- Shop Content -->
                            <div class="select-shop position-absolute bg-white">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <div id="introduct3" class="introduct">
                                                <h4 class="select-heading">COLLECTION LAYOUT</h4>
                                                <ul class="list-unstyled" style="font-size: 14px;">
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout 01 -
                                                            Left sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none text-nowrap"
                                                            href="">Layout 02 - List collection</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Coming
                                                            soon...</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div id="introduct4" class="introduct">
                                                <h4 class="select-heading">COLLECTION LAYOUT</h4>
                                                <ul class="list-unstyled" style="font-size: 14px;">
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout 01 -
                                                            Classic</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout 02 -
                                                            Scroll fixed</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout 03 -
                                                            With video</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout 04 -
                                                            Upssell</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Layout 05 -
                                                            Crosssell</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Soldout - In
                                                            coming</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Product
                                                            countdown</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Coming
                                                            soon...</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div id="product4" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/img2_1_b545762b-1e46-41ff-89ed-b2677e963974.png' )}}" alt="" class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">HOODIES</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="product5" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/img2_2_bdf5e411-5984-4eb0-a445-ec2464db5560.png' )}}" alt="" class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">BAGS & HATS</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="product6" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/img2_3_1.png' )}}" alt=""
                                                        class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">FACE MASKS</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        {{-- <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Đồ chạy bộ
                            </a>
                        </li>
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Đồ tập Gym
                            </a>
                        </li>
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Giảm giá
                            </a>
                        </li>
                        <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Tin tức
                            </a>
                        </li> --}}
                        {{-- <li class="header__navbar-item mx-3">
                            <a class="header__navbar-link text-decoration-none fw-bold" href="">
                                Giới thiệu
                            </a>
                            <!-- Pages Content -->
                            <div class="select-pages position-absolute bg-white">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <div id="introduct5" class="introduct">
                                                <h4 class="select-heading">PAGE SERVICES</h4>
                                                <ul class="list-unstyled" style="font-size: 14px;">
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Privacy
                                                            Policy</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none text-nowrap"
                                                            href="">Delivery Policy</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Refund
                                                            Policy</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Contact
                                                            Information</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Terms of
                                                            Service</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Payment
                                                            Methods</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div id="introduct6" class="introduct">
                                                <h4 class="select-heading">PAGE</h4>
                                                <ul class="list-unstyled" style="font-size: 14px;">
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">About Us</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Contact
                                                            Us</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Faqs</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Blog</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">DMCA</a>
                                                    </li>
                                                    <li>
                                                        <a class=" text-link text-decoration-none" href="">Lookbook</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div id="product7" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/img2_4_1.png' )}}" alt=""
                                                        class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">SNEAKERS</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="product8" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/img2_5.png' )}}" alt=""
                                                        class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">BOOTS</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div id="product9" class="product-item">
                                                <div class="product-img__wrapper overflow-hidden">
                                                    <img src="{{ asset('/images/img2_6_cc704011-a86a-4a49-be0a-73a2bf04aad7.png' )}}" alt="" class="product-item__img w-100">
                                                </div>
                                                <div class="fs-name text-center mt-2 fw-bold">T-SHIRTS</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </nav>
                <div class="header__mobile d-flex justify-content-between align-items-center">
                    <div class="header__mobile-left d-md-none d-flex align-items-center">
                        <div class="mobile__category px-3">
                            <i class="fa-solid fa-bars fs-5"></i>
                        </div>
                        <div class="mobile__search">
                            <label for="checkbox-search" style="margin-bottom: 5px;">
                                <a class="text-decoration-none" style="cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M19 19L13.0001 13M15 8C15 11.866 11.866 15 8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8Z"
                                            stroke-width="2" stroke=black stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </label>
                        </div>
                    </div>
                    <div class=" header__nav-right d-flex align-items-center justify-content-end">
                        <div class="header__secondary-links d-flex">
                            <div href="" class="me-4 ">
                                <label for="checkbox-search" class="d-md-block d-none">
                                    <a class="text-decoration-none" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M19 19L13.0001 13M15 8C15 11.866 11.866 15 8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </a>
                                </label>
                                <input type="checkbox" name="" id="checkbox-search" style="display: none;">
                                <label for="checkbox-search" class="overlay"></label>
                                <!-- select - search -->
                                <div class="header__search p-3">
                                    <label for="checkbox-search" class="position-absolute"
                                        style="right: 20px; cursor: pointer;">
                                        <svg focusable="false" width="14" height="14"
                                            class="icon icon--close " viewBox="0 0 14 14">
                                            <path d="M13 13L1 1M13 1L1 13" stroke="currentColor" stroke-width="2"
                                                fill="none">
                                            </path>
                                        </svg>

                                    </label>
                                    <div class="header__Search-head d-flex border-bottom pb-3">
                                        <a class="text-decoration-none" href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <path
                                                    d="M19 19L13.0001 13M15 8C15 11.866 11.866 15 8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8Z"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('product.search') }}">
                                            <input id="search-input" class="ps-1 ms-2 border-none w-100" type="text"
                                                name="s" id="" placeholder="What are you looking for?"
                                                autofocus>
                                        </form>
                                    </div>
                                    <div class="header__search-body mt-5">
                                        <h3 class="select-heading">POPULAR</h3>
                                        <ul class="list-unstyled">
                                            <li>
                                                <a style="font-size: 13px;" class="text-link text-decoration-none"
                                                    href="">All
                                                    Collection</a>
                                            </li>
                                            <li>
                                                <a style="font-size: 13px;" class="text-link text-decoration-none"
                                                    href="">All
                                                    Product</a>
                                            </li>
                                            <li>
                                                <a style="font-size: 13px;" class="text-link text-decoration-none"
                                                    href="">Contact</a>
                                            </li>
                                            <li>
                                                <a style="font-size: 13px;" class="text-link text-decoration-none"
                                                    href="">Blog</a>
                                            </li>
                                        </ul>
                                        <h3 class="select-heading">INFORMATION</h3>
                                        <a style="font-size: 13px;" class="text-link text-decoration-none"
                                            href="">Contact</a>
                                    </div>
                                </div>
                            </div>
                            <div href="" class="user text-decoration-none me-4 position-relative">
                                <a style="cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 22 22" fill="none">
                                        <path
                                            d="M4.3163 18.4384C4.92462 17.0052 6.34492 16 8 16H14C15.6551 16 17.0754 17.0052 17.6837 18.4384M15 8.5C15 10.7091 13.2091 12.5 11 12.5C8.79086 12.5 7 10.7091 7 8.5C7 6.29086 8.79086 4.5 11 4.5C13.2091 4.5 15 6.29086 15 8.5ZM21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                                <!-- Select - user -->
                                <ul class="user-select list-unstyled position-absolute p-2">
                                    <li>
                                        <a class=" d-block fs-12px text-link text-decoration-none" id="loginName"
                                            href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li>
                                        <a class=" d-block fs-12px text-link text-decoration-none" id="registerName"
                                            href="{{ route('register') }}">Register</a>
                                    </li>
                                    <li>
                                        <a style="cursor: pointer;"
                                            class=" d-block fs-12px text-link text-decoration-none"
                                            id="checkOut">Check
                                            out</a>
                                    </li>
                                    <li>
                                        <a class=" d-block fs-12px text-link text-decoration-none"
                                            href="">Compare
                                            (0)</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="" class="text-decoration-none me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 22 22" fill="none">
                                    <path
                                        d="M11 21C16.5228 21 21 16.5228 21 11C21 5.47715 16.5228 1 11 1C5.47715 1 1 5.47715 1 11C1 16.5228 5.47715 21 11 21Z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.9966 8.06791C9.9969 6.8992 8.32987 6.58482 7.07735 7.65501C5.82482 8.72519 5.64848 10.5145 6.6321 11.7802C7.26211 12.5909 8.87558 14.0942 9.95424 15.0704C10.3127 15.3947 10.4919 15.5569 10.7066 15.622C10.8911 15.6779 11.102 15.6779 11.2866 15.622C11.5012 15.5569 11.6805 15.3947 12.0389 15.0704C13.1176 14.0942 14.731 12.5909 15.3611 11.7802C16.3447 10.5145 16.1899 8.71393 14.9158 7.65501C13.6417 6.59608 11.9963 6.8992 10.9966 8.06791Z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>

                            <!-- giỏ hàng -->
                            <div class="me-4">
                                <label for="checkbox-cart" href="" class="">
                                    <a href="{{ route('cart.index') }}" style="position: relative; cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22"
                                            viewBox="0 0 20 22" fill="none">
                                            <path
                                                d="M3.52 1.64L1.96 3.72C1.65102 4.13198 1.49652 4.33797 1.50011 4.51039C1.50323 4.66044 1.57358 4.80115 1.69175 4.89368C1.82754 5 2.08503 5 2.6 5H17.4C17.915 5 18.1725 5 18.3083 4.89368C18.4264 4.80115 18.4968 4.66044 18.4999 4.51039C18.5035 4.33797 18.349 4.13198 18.04 3.72L16.48 1.64M3.52 1.64C3.696 1.40533 3.784 1.288 3.89552 1.20338C3.9943 1.12842 4.10616 1.0725 4.22539 1.03845C4.36 1 4.50667 1 4.8 1H15.2C15.4933 1 15.64 1 15.7746 1.03845C15.8938 1.0725 16.0057 1.12842 16.1045 1.20338C16.216 1.288 16.304 1.40533 16.48 1.64M3.52 1.64L1.64 4.14666C1.40254 4.46328 1.28381 4.62159 1.1995 4.79592C1.12469 4.95062 1.07012 5.11431 1.03715 5.28296C1 5.47301 1 5.6709 1 6.06666L1 17.8C1 18.9201 1 19.4802 1.21799 19.908C1.40973 20.2843 1.71569 20.5903 2.09202 20.782C2.51984 21 3.07989 21 4.2 21L15.8 21C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V6.06667C19 5.6709 19 5.47301 18.9628 5.28296C18.9299 5.11431 18.8753 4.95062 18.8005 4.79592C18.7162 4.62159 18.5975 4.46328 18.36 4.14667L16.48 1.64M14 9C14 10.0609 13.5786 11.0783 12.8284 11.8284C12.0783 12.5786 11.0609 13 10 13C8.93913 13 7.92172 12.5786 7.17157 11.8284C6.42143 11.0783 6 10.0609 6 9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                        <div class="cart-label">
                                            0
                                        </div>
                                    </a>
                                </label>
                               
                            </div>
                        </div>
                        <div class="header__menu border-start border-dark d-flex align-items-center p-md-4 p-3"
                            style="height: 68px;">
                            <label for="menu-selection" style="cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="17"
                                    viewBox="0 0 40 17" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M40 1H0V0H40V1Z" fill="black">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M40 9H0V8H40V9Z" fill="black">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M40 17H0V16H40V17Z"
                                        fill="black">
                                    </path>
                                </svg>
                            </label>
                            <input type="checkbox" name="" id="menu-selection" class="d-none">
                            <label for="menu-selection" class="overlay"></label>
                            <!-- menu - selection -->
                            <div class="menu-selection position-fixed p-5 top-0 bottom-0 end-0 bg-white"
                                style="width: 400px; z-index: 2; padding-top: 100px !important;">
                                <label for="menu-selection" class="cursor-pointer menu-close position-absolute"
                                    style="left: 30px; top:30px">
                                    <i class="fs-4 fa-solid fa-xmark"></i>
                                </label>
                                <a href="">
                                    <img src="{{ asset('/images/logo_1.png') }}" alt="">
                                </a>
                                <!-- test row col -->
                                <div class="img-list my-5" style="display: flex; flex-wrap: wrap; margin: 0 -6px;">
                                    <div class="" style="padding:0 6px; width: 33.3%;">
                                        <img style="width: 100%; height: auto; margin-bottom:12px"
                                            src="{{ asset('/images/home7_5.png') }}" alt="">

                                    </div>
                                    <div class="" style="padding:0 6px; width: 33.3%;">
                                        <img style="width: 100%; height: auto; margin-bottom:12px"
                                            src="{{ asset('/images/home7_5.png') }}" alt="">

                                    </div>
                                    <div class="" style="padding:0 6px; width: 33.3%;">
                                        <img style="width: 100%; height: auto; margin-bottom:12px"
                                            src="{{ asset('/images/home7_5.png') }}" alt="">

                                    </div>
                                    <div class="" style="padding:0 6px; width: 33.3%;">
                                        <img style="width: 100%; height: auto;"
                                            src="{{ asset('/images/home7_5.png') }}" alt="">

                                    </div>
                                    <div class="" style="padding:0 6px; width: 33.3%;">
                                        <img style="width: 100%; height: auto;"
                                            src="{{ asset('/images/home7_5.png') }}" alt="">

                                    </div>
                                    <div class="" style="padding:0 6px; width: 33.3%;">
                                        <img style="width: 100%; height: auto;"
                                            src="{{ asset('/images/home7_5.png') }}" alt="">

                                    </div>
                                </div>
                                <div class="menu-selection__contact">
                                    <p class="my-0">Address: 570 8th Ave, New York, NY 10018 United States</p>
                                    <span style="color: var(--primary-color)" class="my-3 d-inline-block">+1
                                        718-904-4450</span><br>
                                    <span>support@example.com</span>
                                </div>
                                <ul class="list-unstyled d-flex align-items-center start-50 translate-middle position-absolute"
                                    style="bottom: 60px">
                                    <li class="px-2 border-end border-dark">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">FACEBOOK</a>
                                    </li>
                                    <li class="px-2 border-end border-dark">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">INSTAGRAM</a>
                                    </li>
                                    <li class="px-2 border-end border-dark">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">INSTAGRAM</a>
                                    </li>
                                    <li class="ps-2">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">YOUTUBE</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
        <div class="footer">
            <div class="footer-contact">
                <div class="container-fluid">
                    <div class="row my-5">
                        <div class="border-top border-bottom col-md-4 border-end border-dark" style="padding:60px">
                            <div class=" footer-contact__item">
                                <h3>Liên Hệ Với Chúng Tôi</h3>
                                <p class="my-0">234 Nguyễn Văn Linh, Phường Thạc Gián, Quận Thanh Khê, TP. Đà Nẵng
                                </p>
                                <span style="color: var(--primary-color)"
                                    class="my-3 d-inline-block">086-286-606</span><br>
                                <span>support@overflow-vietnam.com</span>
                            </div>
                        </div>
                        <div class="border-top border-bottom col-md-4 border-end border-dark" style="padding:60px">
                            <div class=" footer-contact__item">
                                <h3>Đăng Ký Nhận Tin</h3>
                                <p style="font-size: 14px;font-weight: lighter;">Đăng ký để nhận tin tức và sự kiện mới
                                    nhất.</p>
                                <form action=""
                                    class="d-flex justify-content-between footer-contact__input-wrapper">
                                    <input id="footer-email" class="w-100 flex-grow-1 fw-light footer-contact__input"
                                        type="email" name="" id="" placeholder="Email Của Bạn...">
                                    <button type="submit" style="white-space: nowrap;">
                                        <span class="text-dark fw-bold fs-12px ">Đăng Ký</span>
                                    </button>
                            </div>
                        </div>
                        <div class="border-top border-bottom border-dark col-md-4" style="padding:60px">
                            <div class=" footer-contact__item">
                                <h3>Theo Dõi Chúng Tôi</h3>
                                <ul class="footer-contact__item--social list-unstyled d-flex overflow-scroll">
                                    <li class="footer-contact__item--social-item">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">FACEBOOK</a>
                                    </li>
                                    <li class="footer-contact__item--social-item">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">INSTAGRAM</a>
                                    </li>
                                    <li class="footer-contact__item--social-item">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">INSTAGRAM</a>
                                    </li>
                                    <li class="footer-contact__item--social-item">
                                        <a href=""
                                            class="text-link fs-12px text-decoration-none text-dark fw-bolder">YOUTUBE</a>
                                    </li>
                                </ul>
                                <ul class="mt-5 footer-contact__item--policy list-unstyled d-flex gap-2 ">
                                    <li class="footer-contact__item--policy-item text-center">
                                        <a class="text-gray text-link" href="">Điều Khoản & Điều Kiện</a>
                                    </li>
                                    <li class="footer-contact__item--policy-item text-center">
                                        <a class="text-gray text-link" href="">Chính Sách Cookies</a>
                                    </li>
                                    <li class="footer-contact__item--policy-item text-center">
                                        <a class="text-gray text-link" href="">Privacy Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <p class="text-center text-gray">© 2023 Bản quyền thuộc về Công ty <a class="text-dark"
                        href="https://fb.com/LeHuuTin.DEV" target="_blank">Overflow </a>Việt Nam</p>
            </div>
        </div>
        <a id="scrollToTopBtn" href="#top" class="to-top position-fixed"
            style="width: 50px;height: 50px; bottom:20px;cursor: pointer; right:10px; border: none; background-color:#000; border-radius: 50%;">
            <svg style="width: 20px; height:30px;" aria-hidden="true" focusable="false" role="presentation"
                class="icon icon-arrow-up position-absolute top-50 start-50 translate-middle" viewBox="0 0 32 32">
                <path fill="#fff" d="M26.984 23.5l1.516-1.617L16 8.5 3.5 21.883 5.008 23.5 16 11.742z"></path>
            </svg>
        </a>
    </div>
    <script src="{{ asset('/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnAdd = document.querySelector('.btn__add');
            const btnRemove = document.querySelector('.btn__remove');
            const inputQty = document.querySelector('.input__quantity');

            btnAdd.addEventListener('click', function(e) {
                e.preventDefault();
                let currentVal = parseInt(inputQty.value);
                inputQty.value = currentVal + 1;
            });

            btnRemove.addEventListener('click', function(e) {
                e.preventDefault();
                let currentVal = parseInt(inputQty.value);
                if (currentVal > 1) {
                    inputQty.value = currentVal - 1;
                }
            });
        });
    </script>
</body>

</html>
