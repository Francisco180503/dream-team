<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Denuncia; 
use App\Models\Auditor;
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
       // Notificar al correo del equipo
       Notification::route('mail', '2020230001@udh.edu.pe')
           ->notify(new DenunciaUrgenteNotificacion($denuncia));
   
       // Notificar al auditor responsable
       if ($denuncia->auditor_recepcion_id) {
           $auditor = \App\Models\Auditor::find($denuncia->auditor_recepcion_id);
           if ($auditor) {
               Notification::route('mail', $auditor->email)
                   ->notify(new DenunciaUrgenteNotificacion($denuncia));
           }
       }
   }
}
