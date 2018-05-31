@extends('layouts.BaseLayout')
@section('container')

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-bottom: 30px;">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url({{ asset('storage/sliderImages/image1.jpg') }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>PHP advanced</h3>
                        <p></p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url({{ asset('storage/sliderImages/image2.jpg') }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Basics of PHP programming</h3>
                        <p></p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    <h1>Basics of PHP programming</h1>
        <p>
            PHP programming language is designed for most web pages and systems, it is relatively easy and quick to learn. The programmers of this language can carry out many of the work required by different companies, so the demand for these professionals is not reduced - both for employees and for freelancers.
            PHP Programming Basics courses are designed for those who want to master the essence of programming in a short time. During the course you will learn how to use PHP programming language and database sites, creating information systems, as well as managing WordPress Content Management System.
        </p>
    <hr>
        <h1>PHP advanced</h1>
        <p>
            During this course, you will learn how to use the PHP programming framework Laravel, find out who is and how to use design patterns and learn how to create e-learning. commercial systems using Prestashop CMS.
        </p>
        <hr>
@endsection
