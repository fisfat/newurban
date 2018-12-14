@extends('layouts.app')

    @section('banner')
        <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                    
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="http://www.jonathanmelody.com/wp-content/uploads/2017/05/o-MAN-WOMAN-WRITING-facebook.jpg" style="max-width:100%; height:350px;" alt="First slide">
                    </div>
                    
                    <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="https://odysseyonline-img.rbl.ms/simage/https%3A%2F%2Fassets.rbl.ms%2F10738552%2F980x.jpg/2000%2C2000/fyWz0xJzvaEnTEAA/img.jpg" style="width:100%; height:350px;" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="https://s-i.huffpost.com/gen/2726216/images/o-WRITING-facebook.jpg" style="width:100%; height:350px;" alt="Third slide">
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
        <div id="carouselExampleIndicators" class="carousel slide d-block d-md-none" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                    
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="http://www.jonathanmelody.com/wp-content/uploads/2017/05/o-MAN-WOMAN-WRITING-facebook.jpg" style="max-width:100%; height:200px;" alt="First slide">
                    </div>
                    
                    <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="https://odysseyonline-img.rbl.ms/simage/https%3A%2F%2Fassets.rbl.ms%2F10738552%2F980x.jpg/2000%2C2000/fyWz0xJzvaEnTEAA/img.jpg" style="width:100%; height:200px;" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="https://s-i.huffpost.com/gen/2726216/images/o-WRITING-facebook.jpg" style="width:100%; height:200px;" alt="Third slide">
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
    @endsection
    @section('nav2')
        <div class="d-none d-md-block">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <form id="search" role="get" class="" action="/find" style="width:50%;">
                            <div class="input-group">
                                <input type="submut" name="req" value="" placeholder="search for a post" class="form-control">
                                <span class="input-group-btn"> <button type="button" name="button" class="btn btn-primary"> <i class="fa fa-search" id="icon2"></i> </button> </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-md-none">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <form id="search" role="get" class="" action="/find" style="width:80%;">
                            <div class="input-group">
                                <input type="submit" name="req" value="" placeholder="search for a post" class="form-control">
                                <span class="input-group-btn"> <button type="button" name="button" class="btn btn-primary"> <i class="fa fa-search" id="icon2"></i> </button> </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@section('content')
    <div class="card">

        <div class="card-header">
            <h3 class="text-center">LATEST DIGEST</h3>
        </div>

        <div class="card-body">
            <ul class="list-group list-unstyled text-center">
                @foreach($articles as $article)
                    <a href="/articles/{{$article->id}}"><li class="list-group-item">{{$article->title}} <em style="font-size:12px">Posted at: {{$article->created_at}}</em></li></a>
                @endforeach
            </ul>
        </div>
    </div>
    <div class=" row justify-content-center m-4 ">
        {{ $articles->onEachSide(4)->links() }}
    </div>
    

@endsection
