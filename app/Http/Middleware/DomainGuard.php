<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DomainGuard
{
    /** quick, friendly scope check (English + French keywords) */
    private array $allow = [
        // English
        'child', 'children', 'minor', 'juvenile', 'adoption', 'custody', 'guardianship',
        'child labour', 'child labor', 'trafficking', 'maintenance', 'abuse', 'violence',
        'birth certificate', 'birth registration', 'ministry of social affairs', 'social welfare',
        'orphan', 'orphanage', 'ngo', 'cameroon', 'juvenile court',
        // French
        'enfant', 'mineur', 'droit de l\'enfant', 'adoption', 'garde', 'tutelle',
        'pension alimentaire', 'maltraitance', 'violence', 'certificat de naissance',
        'enregistrement des naissances', 'ministère des affaires sociales', 'orphelinat',
        'association', 'cameroun', 'tribunal pour enfants',
    ];

    public function handle(Request $request, Closure $next)
    {
        $text = (string) $request->input('message', '');
        $textLower = Str::lower($text);

        $inScope = collect($this->allow)->first(fn($k) => Str::contains($textLower, Str::lower($k)));

        if (!$inScope) {
            return response()->json([
                'answer' => "I’m limited to **child law in Cameroon and orphanages**. "
                          . "Please rephrase your question within that scope.",
                'blocked_by' => 'domain_guard',
            ], 200);
        }

        return $next($request);
    }
}
