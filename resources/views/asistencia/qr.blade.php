
@extends('layouts.principal')

@section('content')
<section class="content py-5">
    <div class="container text-center">
        <h1 class="mb-4">Tu código QR</h1>

        <!-- Todo lo que está dentro de este div se convertirá en imagen -->
        <div id="qr-container" class="mt-4 p-4 d-inline-block bg-white border rounded shadow-sm">
            <h3>{{ $user->name }}</h3>
            <p><strong>Evento:</strong> {{ $evento->nombre }}</p>
            <div class="mt-3">{!! $qrCode !!}</div>
        </div>
        <div>
            <button id="descargar-btn" class="btn btn-primary mt-10">Descargar QR</button>
        </div>

        
    </div>
</section>

<!-- html2canvas para convertir el contenido HTML en imagen -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
    document.getElementById('descargar-btn').addEventListener('click', function () {
        const qrContainer = document.getElementById('qr-container');

        html2canvas(qrContainer).then(canvas => {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'QR_{{ $user->name }}_{{ $evento->nombre }}.png';
            link.click();
        });
    });
</script>
@endsection
