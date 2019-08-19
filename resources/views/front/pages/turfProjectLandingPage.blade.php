@extends('front.layouts.landingPage')

@section('head')
    <title>Sintético S. Mamede</title>
    <link rel="stylesheet" href="/css/front/turf-project-landing-page.css">
    <link rel="stylesheet" href="/css/front/field-purchases.css">
    <link rel="stylesheet" href="/css/front/footer-style.css">
@endsection

@section('page-content')
    <div class="green-top"></div>
    <div class="first-canvas">
        <div class="main-title">
            <h1 class="center">Projeto Relva Sintética</h1>
            <div class="images">
                <img src="/images/campo_relva.jpg" alt="">
            </div>
            <p class="flow-text center">
                O S. Mamede, em conjunto com algumas entidades locais, está a angariar fundos para a substituição do
                piso para uma superficie sintética que se assemelha a relva natural.
            </p>
        </div>
    </div>

    <div class="parallax-container" id="parallax_1">
        <div>
            <h2 class="parallax-title">COMO AJUDAR?</h2>
        </div>
        <div class="parallax"><img src="/images/campo_atual.jpg"></div>
    </div>

    <div class="second-canvas">
        <div class="container">
            <div class="row" id="ways-to-help">
                <div class="col l3 m6 s12">
                    <img src="/images/heart.png">
                    <h3 class="center">Doação Simples</h3>
                    <span class="text-justify">Se é uma pessoa ou uma empresa pode doar um valor em dinheiro para a conta oficial.</span>
                </div>

                <div class="col l3 m6 s12">
                    <img src="/images/ruler.png">
                    <h3 class="center">Comprar Metros</h3>
                    <span class="text-justify">Particulares e empresas podem comprar metros do campo. Quantos mais metros comprar mais visível será o seu nome.</span>
                </div>

                <div class="col l3 m6 s12">
                    <img src="/images/billboard.png">
                    <h3 class="center">Publicidade</h3>
                    <span class="text-justify">Exponha a sua empresa. Garanta um espaço para divulgar a sua marca no novo campo. Entre em contacto com o clube para saber mais.</span>
                </div>

                <div class="col l3 m6 s12">
                    <img src="/images/megaphone.png">
                    <h3 class="center">Passa a Palavra</h3>
                    <span class="text-justify">Mesmo que não tenha possibilidade de contribuir monetariamente, divulgue este projeto com familiares e amigos.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="parallax-container" id="parallax_2">
        <div>
            <h2 class="parallax-title">COMPRAR METROS</h2>
            <div class="meters-explain">
                <div>
                    <span class="step center-align">1</span>
                    <span>Escolha o Sítio</span>
                </div>

                <div>
                    <span class="step center-align">2</span>
                    <span>Escolha uma cor</span>
                </div>

                <div>
                    <span class="step center-align">3</span>
                    <span>Escolha uma letra</span>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="/images/campo_atual2.jpg"></div>
    </div>

    <div id="field_purchases">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l6">
                    <h4>Campo</h4>
                    <div class="field-outter">
                        <img class="field_image" src="/images/field_purchases/current.png">
                    </div>
                </div>
                <div class="col s12 m12 l6">
                    <h4>Quem tem mais metros?</h4>
                    <ul class="top-buyers">
                        @foreach($top_buyers as $key => $top_buyer)
                            <li>
                                <span>{{ $key + 1 }}</span>
                                <span class="text-truncate">{{ \Illuminate\Support\Str::limit($top_buyer['field_purchaser']->name, 17) }}</span>
                                <span>{{ $top_buyer['meters'] }}m&sup2;</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="partners">
        <div class="container">
            <h3>Parceiros</h3>
            <div class="row">
                <div class="col xs12 s6 m4 l4 partner">
                    <a href="https://cm-barcelos.pt/" target="_blank">
                        <img src="/images/cm_barcelos.png" alt="">
                    </a>
                </div>

                <div class="col xs12 s6 m4 l4 partner">
                    <a href="https://www.cm-barcelos.pt/locais/lista/uniao-de-freguesias-de-tamel-santa-leocadia-e-vilar-do-monte"
                       target="_blank">
                        <img src="/images/junta_tsl_vm.png" alt="">
                    </a>
                </div>

                <div class="col xs12 s6 m4 l4 partner">
                    <a href="https://escolasacademia.sporting.pt/pt/eas-barcelos" target="_blank">
                        <img src="/images/eas_barcelos_silva.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('front.partials.footer')
@endsection

@section('scripts')
    <script src="/js/front/field-purchases.js"></script>
    <script src="/js/front/turf-project-landing-page.js"></script>
    <script>
        $(document).ready(function () {
            $('.parallax').parallax();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.materialboxed').materialbox();
        });
    </script>

@endsection