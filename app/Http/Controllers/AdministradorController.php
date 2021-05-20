<?php

namespace App\Http\Controllers;
use DB;
use Spatie\QueryBuilder\QueryBuilder;

// use App\Administrador;

use App\Models\Administrador;
use App\Models\Propriedade;
use App\Models\Utilizador;
use App\Models\Interessado;
use App\Models\Senhorio;
use App\Models\Inquilino;
use App\routes\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    // ###################################################### Administradores ######################################################

    // Show Administrador Home Page

    public function homeAdministradores()
    {
        return view('admin_home');
    }

    // Create Administrador

    public function createAdministrador(Request $request)
    {
        print_r($request->input());
        $order = new Administrador;
        $order->Username=$request->Username;
        $order->Email=$request->Email;
        $order->PrimeiroNome=$request->PrimeiroNome;
        $order->UltimoNome=$request->UltimoNome;
        $order->Password=$request->Password;
        $result = $order->save();
    }

    // List Administradores

    public function allAdministradores()
    {
        $administrador = Administrador::all();
        return response()->json($administrador);
    }

    // Show Administrador by Username

    public function administradorProfile($username)
    {
        $administrador = Administrador::all();

        return view('profile_admin',['data'=>$administrador]);
    }

    // Update Administrador

    public function updateAdministrador(Request $request)
    {
        $data = Administrador::find("unirent_admin");

        $data->Email=$request->mail;
        $data->PrimeiroNome=$request->primeiroNome;
        $data->UltimoNome=$request->ultimoNome;
        $data->Password=$request->password;
        $data->save();
        
        $administrador = Administrador::where('username','=' ,'unirent_admin')->get();

        return view('profile_admin',['data'=>$administrador]);
    }

    // Delete Administrador

    public function deleteAdministrador($username)
    {
        $administrador = Administrador::find($username);
        $administrador->delete();
        
        return response()->json('Admin removed successfully.');
    }

    // ###################################################### Utilizadores ######################################################

    // Create Utilizador

    public function createUtilizador(Request $request)
    {
        print_r($request->input());
        $order = new Utilizador;
        $order->Username=$request->Username;
        $order->Email=$request->Email;
        $order->Password=$request->Password;
        $order->PrimeiroNome=$request->PrimeiroNome;
        $order->UltimoNome=$request->UltimoNome;
        $order->Nacionalidade=$request->Nacionalidade;
        $order->Nascimento=$request->Nascimento;
        $order->Morada=$request->Morada;
        $order->Telefone=$request->Telefone;
        $order->TipoConta=$request->TipoConta;
        $order->Saldo=$request->Saldo;

        $result = $order->save();
    }

    // List Utilizadores

    public function allUtilizadores()
    {
        $utilizadores = Utilizador::all();
        return response()->json($utilizadores);
    }

    // Show Utilizador by Username

    public function utilizadorProfile($username)
    {
        $utilizador = Utilizador::where('username','=' ,$username)->get();

        return view('profile_interessado',['data'=>$utilizador]);
    }

    // Update Utilizador

    public function updateUtilizador(Request $request, $username)
    {
        $data = Utilizador::find($username);

        $data->Username=$request->input('Username');
        $data->Email=$request->input('Email');
        $data->Password=$request->input('Password');
        $data->PrimeiroNome=$request->input('PrimeiroNome');
        $data->UltimoNome=$request->input('UltimoNome');
        $data->Nacionalidade=$request->input('Nacionalidade');
        $data->Nascimento=$request->input('Nascimento');
        $data->Morada=$request->input('Morada');
        $data->Telefone=$request->input('Telefone');
        $data->TipoConta=$request->input('TipoConta');
        $data->Saldo=$request->input('DuraSaldocaoAluguer');
        $data->save();
        
        return response()->json('User updated successfully.');
    }

    // Delete Utilizador

    public function deleteUtilizador($username)
    {
        $utilizador = Utilizador::find($username);

        if ($utilizador->TipoConta == "Senhorio") {
            $senhorio = Senhorio::where('Username', $utilizador->Username);
            $senhorioId = Senhorio::where('Username', $utilizador->Username)->value('IdSenhorio');
            $propriedades = Propriedade::where('IdSenhorio', $senhorioId)->get();
            if ($propriedades != "") {
                foreach ($propriedades as $propriedade) {
                    $inquilinos = Inquilino::where('IdPropriedade', $propriedade['IdPropriedade']);
                    if ($inquilinos != "") {

                        $inquilinos->delete();
                    }
                    $propriedade->delete();
                }
            }
            $senhorio->delete();

        } else if ($utilizador->TipoConta == "Interessado") {
            $interessado = Interessado::where('Username', $utilizador->Username);
            $interessado->delete();
        
        } else if ($utilizador->TipoConta == "Inquilino") {
            $inquilino = Inquilino::where('Username', $utilizador->Username);
            $inquilino->delete();
        }

        $utilizador->delete();
        
        return redirect('utilizadoresFind');
    }

    // Find Utilizador

    public function findUtilizador(Request $request)
    {
        $search_data1 = $request->input('username');
        $search_data2 = $request->input('email');
        $search_data3 = $request->input('type');

        if ($search_data1 != ""){
            $utilizadores = Utilizador::where('Username', $search_data1)
            ->get();
        } else if ($search_data2 != ""){
            $utilizadores = Utilizador::where('Email', $search_data2)
            ->get();
        } else if ($search_data1 == "" && $search_data2 == "") {
            if (request()->has('type')) {
                if ($search_data3 != "Todos") {
                    $utilizadores = Utilizador::where('TipoConta', $search_data3)
                    ->get();
                } else {
                    $utilizadores = Utilizador::all();
                }
            } else {
                $utilizadores = Utilizador::all();
            }
        } else {
            $utilizadores = Utilizador::all();
        }

        return view('find_utilizador',compact('utilizadores'));
    }

    // ###################################################### Propriedades ######################################################

     // Create Propriedade

     public function createPropriedade(Request $request)
     {
         print_r($request->input());
         $order = new Propriedade;
         $order->IdPropriedade=$request->IdPropriedade;
         $order->TipoPropriedade=$request->TipoPropriedade;
         $order->Localizacao=$request->Localizacao;
         $order->Latitude=$request->Latitude;
         $order->Longitude=$request->Longitude;
         $order->AreaMetros=$request->AreaMetros;
         $order->Preco=$request->Preco;
         $order->Descricao=$request->Descricao;
         $order->OrientacaoSolar=$request->OrientacaoSolar;
         $order->NumeroQuartos=$request->NumeroQuartos;
         $order->DuracaoAluguer=$request->DuracaoAluguer;
         $order->Lotacao=$request->Lotacao;
         $order->Disponibilidade=$request->Disponibilidade;
         $order->CasasBanho=$request->CasasBanho;
         $order->EstadoConservacao=$request->EstadoConservacao;
 
         $result = $order->save();
     }
    
    // List Propriedades

    public function allPropriedades()
    {
        $propriedades = Propriedade::all();
        return response()->json($propriedades);
    }

    // Show Propriedade by IdPropriedade

    public function propriedadeProfile($idpropriedade)
    {
        $propriedade = Propriedade::where('idpropriedade','=' ,$idpropriedade)->get();
        
        return view('profile_propriedade',['data'=>$propriedade]);
    }

    // Update Propriedade

    public function updatePropriedade(Request $request, $idpropriedade)
    {
        $data = Propriedade::find($idpropriedade);

        $data->IdPropriedade=$request->input('IdPropriedade');
        $data->TipoPropriedade=$request->input('TipoPropriedade');
        $data->Localizacao=$request->input('Localizacao');
        $data->Latitude=$request->input('Latitude');
        $data->Longitude=$request->input('Longitude');
        $data->AreaMetros=$request->input('AreaMetros');
        $data->Preco=$request->input('Preco');
        $data->Descricao=$request->input('Descricao');
        $data->OrientacaoSolar=$request->input('OrientacaoSolar');
        $data->NumeroQuartos=$request->input('NumeroQuartos');
        $data->DuracaoAluguer=$request->input('DuracaoAluguer');
        $data->Lotacao=$request->input('Lotacao');
        $data->Disponibilidade=$request->input('Disponibilidade');
        $data->CasasBanho=$request->input('CasasBanho');
        $data->EstadoConservacao=$request->input('EstadoConservacao');
        $data->save();
        
        return response()->json('Property updated successfully.');
    }

    // Delete Propriedade

    public function deletePropriedade($idpropriedade)
    {
        $propriedade = Propriedade::find($idpropriedade);
        $inquilinos = Inquilino::where('IdPropriedade', $idpropriedade);
        if ($inquilinos != "") {
            $inquilinos->delete();
        }

        $propriedade->delete();
        
        return redirect('propriedadesFind');
    }

    public function findPropriedade(Request $request)
    {
        $search_data1 = $request->input('tipoProp');
        $search_data2 = $request->input('localizacao');
        $search_data3 = $request->input('areaMetros');
        $search_data4 = $request->input('preco');

        if ($search_data1 != "" && $search_data2 != "" && $search_data3 != "" && $search_data4 != ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('Localizacao',$search_data2)
            ->where('AreaMetros', '<',(int)$search_data3)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 == "" && $search_data2 != "" && $search_data3 != "" && $search_data4 != ""){
            $propriedades = Propriedade::where('Localizacao',$search_data2)
            ->where('AreaMetros', '<',(int)$search_data3)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 != "" && $search_data2 == "" && $search_data3 != "" && $search_data4 != ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('AreaMetros', '<',(int)$search_data3)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 != "" && $search_data2 != "" && $search_data3 == "" && $search_data4 != ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('Localizacao',$search_data2)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 != "" && $search_data2 != "" && $search_data3 != "" && $search_data4 == ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('Localizacao',$search_data2)
            ->where('AreaMetros', '<',(int)$search_data3)
            ->get();
        } else if ($search_data1 == "" && $search_data2 == "" && $search_data3 != "" && $search_data4 != ""){
            $propriedades = Propriedade::where('AreaMetros', '<',(int)$search_data3)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 == "" && $search_data2 != "" && $search_data3 == "" && $search_data4 != ""){
            $propriedades = Propriedade::where('Localizacao',$search_data2)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 == "" && $search_data2 != "" && $search_data3 != "" && $search_data4 == ""){
            $propriedades = Propriedade::where('Localizacao',$search_data2)
            ->where('AreaMetros', '<',(int)$search_data3)
            ->get();
        } else if ($search_data1 != "" && $search_data2 == "" && $search_data3 == "" && $search_data4 != ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 != "" && $search_data2 == "" && $search_data3 != "" && $search_data4 == ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('AreaMetros', '<',(int)$search_data3)
            ->get();
        } else if ($search_data1 != "" && $search_data2 != "" && $search_data3 == "" && $search_data4 == ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->where('Localizacao',$search_data2)
            ->get();
        } else if ($search_data1 == "" && $search_data2 == "" && $search_data3 == "" && $search_data4 != ""){
            $propriedades = Propriedade::where('Preco', '<',(int)$search_data4)
            ->get();
        } else if ($search_data1 == "" && $search_data2 == "" && $search_data3 != "" && $search_data4 == ""){
            $propriedades = Propriedade::where('AreaMetros', '<',(int)$search_data3)
            ->get();
        } else if ($search_data1 == "" && $search_data2 != "" && $search_data3 == "" && $search_data4 == ""){
            $propriedades = Propriedade::where('Localizacao',$search_data2)
            ->get();
        } else if ($search_data1 != "" && $search_data2 == "" && $search_data3 == "" && $search_data4 == ""){
            $propriedades = Propriedade::where('TipoPropriedade', $search_data1)
            ->get();
        } else {
            $propriedades = Propriedade::all();
        }

        return view('find_propriedade',compact('propriedades'));
    }
}


?>