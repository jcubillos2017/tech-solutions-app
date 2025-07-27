<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;

class ValorUf extends Component
{
    public $valor;
    public $fecha;

    public function __construct()
    {
        try {
            $response = Http::get('https://mindicador.cl/api/uf');
            
            if ($response->successful()) {
                $data = $response->json();
                $this->valor = $data['serie'][0]['valor'];
                $this->fecha = now()->parse($data['serie'][0]['fecha'])->format('d-m-Y');
            } else {
                $this->valor = 'No disponible';
                $this->fecha = '';
            }
        } catch (\Exception $e) {
            $this->valor = 'Error al consultar';
            $this->fecha = '';
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.valor-uf');
    }
}