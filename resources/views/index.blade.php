@extends('components.layout')

@section('content')
<section class="banner_main">
    <div id="banner1" class="carousel slide" data-ride="carousel">
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="container">
                <div class="carousel-caption">
                   <div class="row">
                      <div class="col-md-6">
                         <div class="text-bg">
                            <span>Elektrinis transportas</span>
                            <h1>Nuoma</h1>
                            <p>Įvairių elektrinių transporto priemonių nuoma kurioje kiekvienas ras sau tinkamą transportą, Siūlome prieinamas kainas ir lanksčias nuomos sąlygas</p>
                            <a href="/login">Prisijungti </a> <a href="/register">Registruotis </a>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="text_img">
                            <figure><img src="images/pc2.png" alt="#"/></figure>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
       <i class="fa fa-chevron-left" aria-hidden="true"></i>
       </a>
       <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
       <i class="fa fa-chevron-right" aria-hidden="true"></i>
       </a>
    </div>
 </section>
 <!-- end banner -->
 <!-- three_box -->
 <div class="three_box margincontent">
    <div class="container">
       <div class="row">
          <div class="col-md-4">
             <div class="box_text">
                <i><img src="images/thr.png" alt="#"/></i>
                <h3>Dviračiai</h3>
                <p>Elektriniai dviračiai puiki alternatyva norintiems važiuoti netik trumpus atstumus ir  jaustis saugiai esant skirtingom oro sąlygom ar dangai.</p>
             </div>
          </div>
          <div class="col-md-4">
             <div class="box_text">
                <i><img src="images/thr1.png" alt="#"/></i>
                <h3>Motoroleriai</h3>
                <p>Transportas kuriuo gali naudotis iki 2 žmonių vienu metu, didelės baterijos užtikrina sklandų važiavima visais atvejais. </p>
             </div>
          </div>
          <div class="col-md-4">
             <div class="box_text">
                <i><img src="images/thr2.png" alt="#"/></i>
                <h3>Paspirtukai</h3>
                <p>Miestui ar bekelei skirtas transportas, kurį patogu neštis su savimi nes neužma daug vietos. </p>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- three_box -->
 <!-- products -->
 <div  class="products">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <h2>Mūsų transporto priemonės</h2>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="our_products">
                
                     <x-transport :transports="$transports" />
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- end products -->
 <!-- customer -->
 <div class="customer">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <h2>Atsiliepimai</h2>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div id="myCarousel" class="carousel slide customer_Carousel " data-ride="carousel">
                <div class="carousel-inner">
                   <div class="carousel-item active">
                      <div class="container">
                         <div class="carousel-caption ">
                            <div class="row">
                               <div class="col-md-9 offset-md-3">
                                 <x-random-comment :rating="$randomrating" />
                                  {{-- <div class="test_box">
                                     <i><img src="images/cos.png" alt="#"/></i>
                                     <h4>Sandy Miller</h4>
                                     <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id</p>
                                 


                                 
                                    </div> --}}
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>


                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 
@endsection