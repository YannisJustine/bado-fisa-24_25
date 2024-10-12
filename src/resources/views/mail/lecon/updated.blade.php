<x-mail::message>
# Mise à jour de votre demande

Bonjour **{{ $lecon->candidat->fullname }}**,

Votre demande est maintenant 
    @if($lecon->statut->id == StatutEnum::PLANIFIE)
        **<span class="text-green">{{ $lecon->statut->statut }}</span>**.
    @elseif($lecon->statut->id == StatutEnum::IMPOSSIBLE || $lecon->statut->id == StatutEnum::REFUSE)
        **<span class="text-red">{{ $lecon->statut->statut }}</span>**.
    @else
        **<span class="text-yellow">{{ $lecon->statut->statut }}</span>**.
    @endif
<p>
    Informations sur la leçon 
</p>

- Formateur : {{ $lecon->formateur->fullname }}
- Type de leçon : {{ $lecon->getType()->toString() }}
- Date : {{ $lecon->date_reservation->format('d/m/Y') }}
- Heure : {{ $lecon->heure_debut }} - {{ $lecon->heure_fin }}

</x-mail::message>
