@extends('layouts.master')

@section('title') Manage Users @endsection

@section('subTitle') Show User @endsection

@section('content')
    <section id="users" class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-content">

            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 float-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('chefagence.rencontre1') }}" class="btn btn-outline-warning btn-rounded">&larr; Retour</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table id="users-table" class="table table-hover table-striped">
                        <tbody class="">
                        <tr>
                            <th>Matricule AEJ</th>
                            <td class="text-left">{{$suivie->matricule_aej}}</td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td class="text-left">{{$suivie->nomprenom}}</td>
                        </tr>
                        <tr>
                            <th>Sexe</th>
                            <td class="text-left">{{ $suivie->sexe }}</td>
                        </tr>
                        <tr>
                            <th>Date de creation</th>
                            <td class="text-left">{{$suivie->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Conseiller Referent</th>
                            <td class="text-left">{{ App\Models\User::where('agence_id', session()->get('orig_agence'))->where('id',$suivie->user_id)->first()->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                    {{--'dureerencontre','approche','typerencontre','modalite', 'status',
                            'axetravail','planaction','dateprochainrdv','observation',
                            'user_id', 'suivirencontre_id','agence_id', 'presencedemandeur'--}}
                    <table class="table" id="rec" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Date Rendez-Vous</th>
                            <th>Type Rencontre</th>
                            <th>Modalite</th>
                            <th>Axe Travail</th>
                            <th>Approche Skill</th>
                            <th>Plan Action</th>
                            <th>Duree Rencontre</th>
                            <th>Status</th>
                            <th>Date de Creation</th>
                        </tr>
                        </thead>
                        <tbody id="rencontreRow">
                        @forelse($rencontres as $item)
                            <tr>
                                <th>{{ \Carbon\Carbon::parse($item->dateprochainrdv)->format('M d, Y')}}</th>
                                <th>Rencontre {{ $item->typerencontre }}</th>
                                <th>{{ $item->modalite }}</th>
                                <th>{{ $item->axetravail }}</th>
                                <th>{{ $item->approche }}</th>
                                <th>{{ $item->planaction }}</th>
                                <th>{{ $item->dureerencontre }}</th>
                                @if($item->status)
                                    <th><span class="badge badge-success">valide</span></th>
                                @else
                                    <th><span class="badge badge-warning">en cour</span></th>
                                @endif
                                <th>{{  \Carbon\Carbon::parse($item->created_at)->format('M d, Y')}}</th>
                            </tr>
                        @empty
                            <td>Pas de donnee trouve</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>


@endsection