<!DOCTYPE html>
<html>
<head>
    <title>Sample PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            margin: 0 auto;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sample PDF</h1>
    </div>
    <div class="content">
        <p>This is a sample PDF document generated with Laravel and Dompdf.</p>
        @foreach ($users as $user)
            {{ $user->nom }}

            <br>
            @foreach ($user->creneaux as $creneau)
                {{ $creneau->heure_debut }}
            @endforeach
        @endforeach
    </div>
</body>
</html>