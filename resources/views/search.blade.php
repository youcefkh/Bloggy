@extends('layouts.app')
@section('content')
    <nav class="breadcrumb" role="navigation" aria-label="Vous êtes ici :">
        <div class="container">
            <p class="breadcrumb-list">
                <span data-test="breadcrumb_element"><a href="{{url("/")}}"> {{__('element.navbar.home')}} </a></span><span class="breadcrumb-separator">&nbsp;></span>
                <strong class="active" data-test="breadcrumb_element" aria-current="page">{{__('text.home.result-search')}}</strong>
            </p>
        </div>
    </nav>
    <div class="container main-container">
        <div id="results" class="col-main">
            <h1 class="result-title">
                <span id="nbResult">{{count($search)}}</span>
                <br>
                    <p>{{__('text.home.result-search')}}</p>
            </h1>
            <div class="content-result-section">
                <div id="fichePratique" class="result-section">
                    <h2 id="nbResult_fichePratique" class="result-section-heading">Sub Catergory AA (1)</h2>
                    <ul id="results_fichePratique" class="result-list">
                        <li id="result_fichePratique_1" class="result-item">
                            <a href="https://www.service-public.fr/particuliers/vosdroits/F124" data-xiti-name="Particuliers::Accueil::passport::Sport_de_compétition" data-xiti-type="navigation">
                                <span class="result-name"><span>Sport de compétition</span></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="annuaire" class="result-section">
                    <h2 id="nbResult_annuaire" class="result-section-heading">Sub Catergory BB (1)</h2>
                    <ul id="results_annuaire" class="result-list">
                        <li id="result_annuaire_1" class="result-item">
                            <a
                                    href="https://lannuaire.service-public.fr/bourgogne-franche-comte/territoire-de-belfort/crib-90010-02"
                                    data-xiti-name="Particuliers::Accueil::passport::Centre_de_ressources_et_d&#39;information_des_bénévoles_(CRIB)_-_Paasport_09_-_Territoire_de_Belfort(90)_-_Foix"
                                    data-xiti-type="navigation"
                            >
                                <span class="result-name"><span>Centre de ressources et d&#39;information des bénévoles (CRIB) - Paasport 09 - Territoire de Belfort(90) - Foix</span></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="actualite" class="result-section">
                    <h2 id="nbResult_actualite" class="result-section-heading">Sub Catergory CC (5)</h2>
                    <ul id="results_actualite" class="result-list">
                        <li id="result_actualite_1" class="result-item">
                            <a
                                    href="https://www.service-public.fr/particuliers/actualites/A14916"
                                    data-xiti-name="Particuliers::Accueil::passport::Le_Pass&#39;Sport_est_étendu_et_prolongé_jusqu&#39;à_fin_février_2022"
                                    data-xiti-type="navigation"
                            >
                                <span class="result-name"><span>Le Pass&#39;Sport est étendu et prolongé jusqu&#39;à fin février 2022</span></span>
                            </a>
                        </li>
                        <li id="result_actualite_2" class="result-item">
                            <a href="https://www.service-public.fr/particuliers/actualites/A15485" data-xiti-name="Particuliers::Accueil::passport::Ce_qui_change_en_février_2022" data-xiti-type="navigation">
                                <span class="result-name"><span>Ce qui change en février 2022</span></span>
                            </a>
                        </li>
                        <li id="result_actualite_3" class="result-item">
                            <a
                                    href="https://www.service-public.fr/particuliers/actualites/A15420"
                                    data-xiti-name="Particuliers::Accueil::passport::Loi_de_finances_pour_2022_:_ce_qui_est_prévu_pour_les_particuliers"
                                    data-xiti-type="navigation"
                            >
                                <span class="result-name"><span>Loi de finances pour 2022 : ce qui est prévu pour les particuliers</span></span>
                            </a>
                        </li>
                        <li id="result_actualite_4" class="result-item">
                            <a href="https://www.service-public.fr/particuliers/actualites/A15082" data-xiti-name="Particuliers::Accueil::passport::Ce_qui_change_en_août_2021" data-xiti-type="navigation">
                                <span class="result-name"><span>Ce qui change en août 2021</span></span>
                            </a>
                        </li>
                        <li id="result_actualite_5" class="result-item">
                            <a
                                    href="https://www.service-public.fr/particuliers/actualites/A15114"
                                    data-xiti-name="Particuliers::Accueil::passport::Protocole_sanitaire,_fournitures,_allocation_et_bourses..._:_l&#39;essentiel_de_la_rentrée_scolaire_2021"
                                    data-xiti-type="navigation"
                            >
                                <span class="result-name"><span>Protocole sanitaire, fournitures, allocation et bourses... : l&#39;essentiel de la rentrée scolaire 2021</span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="otherSearchs">
                <div class="bloc-filtre bloc-filtre-asso">
                    <a id="goToassociationsSearch" href="https://www.service-public.fr/associations/recherche?keyword=passport" data-xiti-name="Particuliers::Accueil::Navigation_Directe::Rechercher_aussi_dans_associations">
                        Rechercher aussi dans Associations
                    </a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
