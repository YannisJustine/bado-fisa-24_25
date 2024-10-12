<x-mail::message>
# Demande de leçon

Bonjour **{{ $lecon->formateur->fullname }}**,

## {{ $lecon->candidat->fullname }} a demandé une leçon.

<p>
    Informations sur la leçon 
</p>

- Type de leçon : {{ $lecon->getType()->toString() }}
- Date : {{ $lecon->date_reservation->format('d/m/Y') }}
- Heure : {{ $lecon->heure_debut }} - {{ $lecon->heure_fin }}

<x-mail::button url="{{ route('formateur') }}#heures">
Voir la demande
</x-mail::button>

</x-mail::message>
