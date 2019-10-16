@extends('web.layouts.app')
@section('banner')
    @include('web.home.banner')
@endsection
@section('content')
    <section id="services" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Our <span>Services</span></h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.</p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                        <div class="icon">
                            <i class="lnr lnr-pencil"></i>
                        </div>
                        <h4>Content Writing</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.4s">
                        <div class="icon">
                            <i class="lnr lnr-cog"></i>
                        </div>
                        <h4>Web Development</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.6s">
                        <div class="icon">
                            <i class="lnr lnr-chart-bars"></i>
                        </div>
                        <h4>Graphic Design</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.8s">
                        <div class="icon">
                            <i class="lnr lnr-layers"></i>
                        </div>
                        <h4>UI/UX Design</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="1s">
                        <div class="icon">
                            <i class="lnr lnr-tablet"></i>
                        </div>
                        <h4>App Development</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="1.2s">
                        <div class="icon">
                            <i class="lnr lnr-briefcase"></i>
                        </div>
                        <h4>Digital Marketing</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section">
        <div class="contact-form">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-9">
                        <div class="contact-block">
                            <div class="section-header">
                                <h2 class="section-title">Contact <span>Us</span></h2>
                                <hr class="lines">
                            </div>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required data-error="Please enter your name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Your Email" id="email" class="form-control" name="name" required data-error="Please enter your email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message" placeholder="Your Message" rows="11" data-error="Write your message" required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="submit-button text-center">
                                            <button class="btn btn-common" id="submit" type="submit">Send Message</button>
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="toggle-map">
            <a href="#" class="map-icon wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                <i class="lnr lnr-map"></i>
            </a>
        </div>
        <div id="google-map">
        </div>
    </section>

    <div id="subscribe" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Subscribe <span>Newsletter</span></h2>
                <hr class="lines">
                <p class="section-subtitle">Subscribe to get all latest news from us.</p>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <form class="text-center form-inline">
                        <input class="mb-20 form-control" name="email" placeholder="Your Email Address">
                        <button class="sub_btn">subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection
