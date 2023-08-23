@extends('layouts.topo')

@section('content')

    <div class="container features ">
        <div class="column is-6 has-text-left ">
            <h1 class="title titulo is-size-3">
                Cotização de cada tipo de  <span> Material reciclável</span>
            </h1>
        </div>
        <div class="column is-12  ">
            <img src="images/cotizacao.png" alt="" class="img-centered">
        </div>
    </div>
    <div class="container">
        <div class="columns">
            <div class="column is-7 is-pulled-left">
                <h1 class="title titulo is-size-4  has-text-left"> Cotização</span></h1>
            </div>
            <div class="column is-5 is-pulled-left">
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-medium" type="search" placeholder="Escreva o nome do material"/>
                    <span class="icon is-medium is-left">
                    <i class="fa fa-search"></i>
                </span>
                </div>
            </div>
        </div>
<br><br><br>

            @for($i=0; $i<3; $i++)
                <cotizacao titulo="Cristal"
                           valor="0,64"
                ></cotizacao>
            @endfor

    </div>



@endsection