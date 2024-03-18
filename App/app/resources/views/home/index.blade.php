@extends('layouts.home')
@section('content')
    @if(count($banner)>0)
    <div class="home-demo home-banner container-fluid">
        <div class="row">
            <div class="large-12 columns">
                <div class="owl-carousel owl-carousel-banner">
                    @for($i=0;$i<count($banner);$i++)
                    <div class="item">
                        <a href="{{url('/')}}/contact-us"><img alt="mainbanner1" class="img-fluid" src="{{url('/')}}/{{$banner[$i]->BannerImage}}"></a>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(array_key_exists("Before Service",$Content))
        @for($i=0;$i<count($Content['Before Service']);$i++)
            <section class=" wow fadeInUp mt-45">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                                <?php echo $Content['Before Service'][$i]->Content; ?>
                        </div>
                    </div>
                </div>
            </section>
        @endfor
    @endif
    @if(count($Services)>0)
        <div class="service-section wow fadeInUp mt-45">
            <div class="container">
                <div class="service-hedaing page-title category-featured">
                    <div class="page-title toggled">
                        <div class="row">
                            <div class="col-4"><span class="page-title-left"></span></div>
                            <div class="col-4"><h3>Our Services</h3></div>
                            <div class="col-4 text-right"><a href="{{url('/')}}/services"><span class="view-all"> View All</span></a></div>
                        </div>
                    </div>
                    <div class="row">
                        @for($i=0;$i<count($Services);$i++)
                        <div class="col-sm-3 col-6">
                            <div class="item service">
                                <div class="col col-xs-12 single-column">
                                    <div class="card service-card h-100 border-0">
                                        <div class="image">
                                            <a href="{{url('/')}}/services/{{$Services[$i]->Slug}}"><img src="{{url('/')}}/{{$Services[$i]->ServiceImage}}" class="card-img-top" alt="..."></a>
                                            <div class="button-group">
                                                <button title="Enquiry" class="btnEnquiry" data-name="{{$Services[$i]->ServiceName}}" data-slug="{{$Services[$i]->Slug}}" data-id="{{Helper::EncryptDecrypt('encrypt',$Services[$i]->ServiceID)}}"><i class="fa-solid fa-message"></i></button>
                                            </div>
                                        </div>
                                        <div class="content service-description">
                                            <div class="caption">
                                                <h4 class="service-title text-center"><a href="{{url('/')}}/services/{{$Services[$i]->Slug}}">{{$Services[$i]->ServiceName}}</a></h4>
                                                <div class="price-rating text-center">
                                                    @if($Settings['show-price-on-home']==true)
                                                        <div class="price">
                                                            <span class="price-new"><i class="fa-solid fa-indian-rupee-sign"></i> {{NumberFormat($Services[$i]->Price,$Settings['price-decimals'])}}</span>
                                                        </div>
                                                    @endif
                                                    <p class="description"><?php echo substr($Services[$i]->ShortDescription, 0, 200) . ".."; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(array_key_exists("After Service",$Content))
        @for($i=0;$i<count($Content['After Service']);$i++)
            <section class=" wow fadeInUp mt-45">
                <div class="container">
                    <div class="row">
                        <div class="col-12"><?php echo $Content['After Service'][$i]->Content; ?></div>
                    </div>
                </div>
            </section>
        @endfor
    @endif

@endsection