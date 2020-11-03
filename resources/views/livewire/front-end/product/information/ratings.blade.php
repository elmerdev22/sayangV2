<div>
    @for ($i = 0; $i < 5; $i++)
        <div class="post clearfix">
            <div class="user-block">
                <img class="img-circle img-bordered-sm mr-3" style="width: 50px; height: 50px;" src="{{asset('images/default-photo/elmer.jpg')}}" alt="User Image">
                <span class="username">
                <a href="#">Sarah Ross</a>
                <a href="#" class="float-right btn-tool">3 days ago</a>
                </span>
                <span class="description">
                @php $star = rand(1,5) @endphp
                @for ($s = 0; $s < $star ; $s++)
                    <span class="fas fa-star text-warning"></span>
                @endfor
                @for ($n = $star; $n < 5 ; $n++)
                    <span class="fas fa-star"></span>
                @endfor
                </span>
            </div>
            <!-- /.user-block -->
            <p class="w-100">
                Lorem ipsum represents a long-held tradition for designers,
                typographers and the like. Some people hate it and argue for
                its demise, but others ignore the hate as they create awesome
                tools to help create filler text for everyone from bacon lovers
                to Charlie Sheen fans.
            </p>
            @php $pic = rand(1,5) @endphp
            @for ($p = 0; $p < $pic ; $p++)
                <img class="" style="width: auto; height: 50px;" src="{{asset('images/default-photo/product1.jpg')}}" alt="User Image">
            @endfor

            <div class="card-footer card-comments mt-3">
                <div class="replied">
                <span class="fas fa-reply"></span> Replied
                </div>
                <div class="card-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="{{asset('images/default-photo/store.png')}}" alt="store Image">

                <div class="comment-text">
                    <span class="username">
                    Elmer Shop
                    <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    Thank you! 
                </div>
                <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
            </div>
        </div>
        <!-- /.card-comment -->
    @endfor
    <div class="row float-right mt-3">
        <button class="btn btn-warning">Load more <span class="fas fa-chevron-right"></span></button>
    </div>
</div>
