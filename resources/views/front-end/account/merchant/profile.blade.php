@extends('front-end.layout')
@section('title','Seller Profile')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark">Profile</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Seller Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-warning card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('images/default-photo/elmer.jpg')}}" alt="User profile picture">
                </div>

                <p class="text-center">Gordon Ramcey <span class="fas fa-star text-warning"></span> 4.5</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Active Product</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-warning btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title text-white">About Seller</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-warning">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#products" data-toggle="tab">Products</a></li>
                  <li class="nav-item"><a class="nav-link" href="#ratings" data-toggle="tab">Ratings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="products">
                    <div class="row pb-3">
                      <div class="col-12">
                        <input type="search" class="form-control" placeholder="Search">
                      </div>
                    </div>
                    @for($x=0;$x<4;$x++)
                      <article class="card card-product-list">
                        <div class="row no-gutters p-2">
                          <aside class="col-5">
                            <a href="#" class="img-wrap">
                              <img class="card-img-top" src="{{asset('images/default-photo/w2.jpg')}}" alt="Card image cap">
                              <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
                            </a>
                          </aside> <!-- col.// -->
                          <div class="col-7 pl-3">
                            <div class="info-main">
                              <div class="row">
                                  <div class="col-6 font-weight-bold text-left">
                                      <span class="h5 title">COCONUT OIL</span>
                                  </div>
                                  <div class="col-6 text-right">
                                      <p class="text-danger">3 LEFT!</p>
                                  </div>
                              </div>
                              
                              <div class="rating-wrap mb-3">
                                <p>Gordon Ramcey <span class="fas fa-star text-warning"></span> 4.5</p>
                              </div> <!-- rating-wrap.// -->
                              
                              <p> Take it as demo specs, ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam... </p>
                              <div class="row">
                                <div class="col-md-6">
                                  <a href="{{route('selected.product', ['slug' => 'product-name'])}}">
                                    <button class="btn btn-sm btn-dark item-btn">
                                      <span class="font-weight-bold">Buy Now</span><br>
                                      <small class="text-white item-info">Php: 40.00 | 30%off</small>
                                    </button>
                                  </a>
                                </div>
                                <div class="col-md-6">
                                  <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
                                    <button class="btn btn-sm btn-outline-warning text-dark item-btn">
                                    <span class="font-weight-bold">Place Bid</span><br>
                                    <small class="item-info">Bids: 5 | Top: 250.00</small>
                                    </button>
                                  </a>
                                </div>
                              </div>
                            </div> <!-- info-main.// -->
                          </div> <!-- col.// -->
                        </div> <!-- row.// -->
                      </article> <!-- card-product .// -->
                    @endfor
                    <nav aria-label="Page navigation sample">
                      <div class="row justify-content-center">
                        <ul class="pagination">
                          <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                          <li class="page-item active"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">»</a></li>
                      </ul>
                      </div>
                    </nav>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="ratings">
                    
                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{asset('images/default-photo/elmer.jpg')}}" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool">3 days ago</a>
                        </span>
                        <span class="description">
                          @for($x=0;$x < 5; $x++)
                            <span class="fas fa-star text-warning"></span>
                          @endfor
                        </span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="White a reply">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-warning">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
