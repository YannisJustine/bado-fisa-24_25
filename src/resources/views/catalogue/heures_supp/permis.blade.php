@extends('layouts.main')

@section('content')

    <div class="container mx-auto flex flex-row flex-wrap justify-evenly flex-1 items-center text-white">
        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white mb-5">{{ $typePermis->libelle }}</h5>

            <form class="space-y-6" method="POST" action="{{ route('achat.heures_supp') }}">
            <div>
                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix unitaire</p>
                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $typePermis->prix_unitaire }} €</p>
            </div>
            <div>
                <label for="quantite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-logo-orange-500 focus:border-logo-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" type="number" name="quantite" id="quantite" min="1" value="1" autocomplete="off">
            </div>
        
            <input type="hidden" name="permis_id" value="{{ $typePermis->id }}">
            @csrf
            <div class="flex items-center">
                <p class="text-xl ms-auto font-medium text-gray-900 dark:text-white start"><span id="prix-total">{{ $typePermis->prix_unitaire }} </span>€</p>
            </div>
            <button type="submit" class="w-full text-white bg-logo-orange-700 hover:bg-logo-orange-800 focus:ring-4 focus:outline-none focus:ring-logo-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-logo-orange-600 dark:hover:bg-logo-orange-700 dark:focus:ring-logo-orange-800">Confirmer l'achat</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>

    window.onload = function () {
        document.getElementById('quantite').addEventListener('input', (event) => {
            let quantite = parseInt(event.target.value);
            let prixUnitaire = {{ $typePermis->prix_unitaire }};
            let prixTotal = quantite * prixUnitaire;
            document.getElementById('prix-total').textContent = prixTotal;
        });
    }

</script>
@endpush
    
