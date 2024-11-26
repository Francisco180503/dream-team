<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Denuncia; 
use Illuminate\Support\Facades\Notification;
use App\Notifications\DenunciaUrgenteNotificacion;



class IdentificarDenunciasUrgentes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'identificar:denuncias-urgentes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $denuncias = Denuncia::where('urgente', false)
            ->where(function ($query) {
                $query->where('impacto', '>=', 4)
                  ->orWhere('created_at', '<', now()->subDays(7));
            })
            ->get();

        foreach ($denuncias as $denuncia) {
            $denuncia->urgente = true;
            $denuncia->save();

            $this->enviarAlerta($denuncia);
        }

        $this->info('Denuncias urgentes identificadas y alertas enviadas.');
    }

    private function enviarAlerta($denuncia)
    {
        Notification::route('mail', '2020230001@udh.edu.pe')
            ->notify(new DenunciaUrgenteNotificacion($denuncia));
    }

}
