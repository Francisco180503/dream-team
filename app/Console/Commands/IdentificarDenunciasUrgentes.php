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
       $denuncias = Denuncia::where('estado_recepcion', 'Pendiente')
           ->where(function ($query) {
               $query->where('fecha_recepcion', '<', now()->subDays(7))
                   ->orWhere('descripcion', 'like', '%corrupción%')
                   ->orWhere('descripcion', 'like', '%fraude%')
                   ->orWhere('descripcion', 'like', '%soborno%')
                   ->orWhere('descripcion', 'like', '%malversación%')
                   ->orWhere('descripcion', 'like', '%abuso de poder%')
                   ->orWhere('funcionarios_involucrados', 'like', '%alto rango%')
                   ->orWhere('entidad_sujeta_control', 'like', '%sector crítico%');
           })
           ->get();

       foreach ($denuncias as $denuncia) {
           // Enviar alerta al equipo
           $this->enviarAlerta($denuncia);
       }

       $this->info('Denuncias urgentes identificadas y alertas enviadas.');
   }

   private function enviarAlerta($denuncia)
   {
       Notification::route('mail', 'your_gmail_address@gmail.com')
           ->notify(new DenunciaUrgenteNotificacion($denuncia));
   }

}
