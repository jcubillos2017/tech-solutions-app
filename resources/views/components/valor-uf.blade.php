<div style="background-color: #e3f2fd; border-left: 6px solid #2196F3; padding: 10px; margin-bottom: 20px;">
    @if($valor !== 'Error al consultar' && $valor !== 'No disponible')
        <p style="margin: 0; font-size: 1.1em;">
            <strong>Valor UF del día ({{ $fecha }}):</strong> ${{ number_format($valor, 2, ',', '.') }}
        </p>
    @else
        <p style="margin: 0; font-size: 1.1em; color: #d32f2f;">
            <strong>Valor UF:</strong> {{ $valor }}
        </p>
    @endif
</div>