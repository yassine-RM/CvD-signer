@extends('pages.master')

@section('body')

@if (!count($cvs))

<div class="row mt-5">
    <div class="col-6 offset-3">

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <h2>Auccun cv trouvé !!! </h2> <a href="/"> crée un cv gratuitement ??</a>
        </div>

    </div>
</div>
@else
<div class="row m-auto">
    @foreach ($cvs as $cv)
    <div class="col-md-4 col-sm-12  mt-2">
        <div class="card img-fluid" style="width: 25rem;">
            @if ($cv->photo)
            <img class="card-img-top h-50" src="{{ asset($cv->photo) }}" alt="Card image cap">
            @else
            <img class="card-img-top h-50" src="{{ asset('images/capture.jpg') }}" alt="Card image cap">
            @endif
            <div class="h-25 card-body text-light">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col">

                                <h5 class="card-title ">
                                    <h3 class="card-text text-center text-warning "
                                        style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                        {{ Auth::user()->civilite }} {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                                    </h3>
                                    <h4 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                        {{ $cv->titre }}</h4>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">{{  str_limit($cv->presentation,45)}}</p>
                                <p class="card-text ">

                                    <i class="text-warning">Date de creation :</i> {{  $cv->created_at}}

                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-warning">

                                Télechargements <i class="fa fa-download"></i> <span
                                    class="badge badge-light">{{ $cv->download }}</span>


                            </div>
                            <div class="col ">
                                <a href="{{ url('/showCv/'.$cv->id.'#comment') }}" class="text-warning">
                                    Commentaires <i class="fa fa-comment"></i> <span
                                        class="badge badge-light">{{ $cv->comments->count() }}</span>

                                </a>
                            </div>


                        </div>
                        <div class="row mt-3">
                            <div class="col">

                                <p class="card-text text-center ">

                                    <a @click.prevent='lienList({{ $cv->id }})' class="btn btn-success btn-sm "
                                        id="cursor" data-toggle="modal" data-target="#lienList">
                                        <i class="fa fa-link"></i></a>

                                </p>
                            </div>
                            <div class="col text-center ">
                                <a @click="visite({{ $cv->id}})" href="{{ url('/showCv/'.$cv->id ) }}">
                                    <button class="btn-sm btn btn-primary">


                                        <i style="font-size:130%" class="fa fa-eye"> </i>
                                        <span class="badge badge-light">{{ $cv->visite }}

                                        </span>
                                    </button>
                                </a>
                            </div>

                            <div class="col text-center ">
                                <a href="{{ url('cvTemplate/'.$cv->id) }}">
                                    <button class="btn-sm btn btn-warning">
                                        <i style="font-size:130%" class="fa fa-edit"> </i>

                                    </button>
                                </a>
                            </div>
                            <div class="col text-center">
                                <button @click.prevent="deleteCv({{ $cv->id}})" class="btn-sm btn btn-danger">
                                    <i style="font-size:130%" class="fa fa-trash"> </i>
                                </button>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@include('pages.lienList')

<div class="row  mt-1">


    <div class=" pagination col-2 offset-5 ">
        {{ $cvs->links() }}
    </div>

</div>
@endsection
