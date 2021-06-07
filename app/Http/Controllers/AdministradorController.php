<?php

namespace App\Http\Controllers;
use DB;
use Spatie\QueryBuilder\QueryBuilder;

// use App\Administrador;

use App\Models\Administrador;
use App\Models\Propriedade;
use App\Models\FotosPropriedades;
use App\Models\HistoricoSaldo;
use App\Models\Restricoes;
use App\Models\Ratings;
use App\Models\Pagamentos;
use App\Models\Local;
use App\Models\Likes;
use App\Models\Indisponivel;
use App\Models\Arrendamento;
use App\Models\Extras;
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
        $administrador = Administrador::all();
        return view('admin_home',['data'=>$administrador]);
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
        $data = Administrador::find("admin");

        $data->Email=$request->mail;
        $data->PrimeiroNome=$request->primeiroNome;
        $data->UltimoNome=$request->ultimoNome;
        $data->Password=$request->password;
        $data->save();
        
        $administrador = Administrador::where('username','=' ,'admin')->get();

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
        $order->imagem=$request->imagem;
        $order->api_token=$request->api_token;
        $order->NIF=$request->NIF;

        $result = $order->save();
    }

    // List Utilizadores

    public function allUtilizadores()
    {
        $utilizadores = Utilizador::all();
        return response()->json($utilizadores);
    }

    // Show Utilizador by Username

    public function utilizadorProfile($iduser)
    {
        $utilizador = Utilizador::where('IdUser','=' ,$iduser)->get();

        return view('profile_interessado',['data'=>$utilizador]);
    }

    // Update Utilizador

    public function updateUtilizador(Request $request, $iduser)
    {
        $data = Utilizador::find($iduser);

        $data->IdUser=$request->iduser;
        $data->Username=$request->name;
        $data->Email=$request->mail;
        $data->Password=$request->password;
        $data->PrimeiroNome=$request->first;
        $data->UltimoNome=$request->last;
        $data->Nacionalidade=$request->nationality;
        $data->Nascimento=$request->birthday;
        $data->Morada=$request->address;
        $data->Telefone=$request->number;
        $data->TipoConta=$request->type;
        $data->Saldo=$request->balance;
        $data->NIF=$request->nif;
        $data->save();
        
        $utilizador = Utilizador::where('IdUser','=' ,$data->IdUser)->get();
        
        return view('profile_interessado',['data'=>$utilizador]);
    }

    // Delete Utilizador

    public function deleteUtilizador($iduser)
    {
        $utilizador = Utilizador::find($iduser);

        if ($utilizador->TipoConta == "Senhorio") {
            $senhorio = Senhorio::where('IdUser', $utilizador->IdUser);
            $senhorioId = Senhorio::where('IdUser', $utilizador->IdUser)->value('IdSenhorio');
            $historicos = HistoricoSaldo::where('IdUser', $iduser)->get();
            $propriedades = Propriedade::where('IdSenhorio', $senhorioId)->get();
            if ($historicos != '[]') {
                foreach ($historicos as $historico) {
                    $historico->delete();
                }
            }
            if ($propriedades != '[]') {
                foreach ($propriedades as $propriedade) {
                    AdministradorController::deletePropriedade($propriedade->IdPropriedade);
                }
            }
            $senhorio->delete();

        } else if ($utilizador->TipoConta == "Interessado") {
            $interessado = Interessado::where('IdUser', $utilizador->IdUser);
            $historicos = HistoricoSaldo::where('IdUser', $iduser)->get();
            if ($historicos != '[]') {
                foreach ($historicos as $historico) {
                    $historico->delete();
                }
            }
            $interessado->delete();
        
        } else if ($utilizador->TipoConta == "Inquilino") {
            $inquilino = Inquilino::where('IdUser', $utilizador->IdUser);
            $idinquilino = Inquilino::where('IdUser', $utilizador->IdUser)->value('IdInquilino');
            $arrendamentos = Arrendamento::where('IdInquilino', $idinquilino)->get();
            $historicos = HistoricoSaldo::where('IdUser', $iduser)->get();
            if ($arrendamentos != '[]') {
                foreach ($arrendamentos as $arrendamento) {
                    $arrendamento->delete();
                }
            }
            if ($historicos != '[]') {
                foreach ($historicos as $historico) {
                    $historico->delete();
                }
            }
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

    // Export Users

    public function exportUsers(Request $request)
    {
        $fileName = 'users.csv';
        $utilizadores = Utilizador::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('IdUser', 'Username', 'Email', 'Password', 'PrimeiroNome', 'UltimoNome', 'Nacionalidade', 'Nascimento', 'Morada', 'Telefone', 'TipoConta', 'Saldo', 'Imagem', 'ApiToken', 'NIF');

        $callback = function() use($utilizadores, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($utilizadores as $utilizador) {
                $row['IdUser'] = $utilizador->IdUser;
                $row['Username'] = $utilizador->Username;
                $row['Email'] = $utilizador->Email;
                $row['Password'] = $utilizador->Password;
                $row['PrimeiroNome'] = $utilizador->PrimeiroNome;
                $row['UltimoNome'] = $utilizador->UltimoNome;
                $row['Nacionalidade'] = $utilizador->Nacionalidade;
                $row['Nascimento'] = $utilizador->Nascimento;
                $row['Morada'] = $utilizador->Morada;
                $row['Telefone'] = $utilizador->Telefone;
                $row['TipoConta'] = $utilizador->TipoConta;
                $row['Saldo'] = $utilizador->Saldo;
                $row['Imagem'] = $utilizador->imagem;
                $row['ApiToken'] = $utilizador->api_token;
                $row['NIF'] = $utilizador->NIF;

                fputcsv($file, array($row['IdUser'], $row['Username'], $row['Email'], $row['Password'], $row['PrimeiroNome'], $row['UltimoNome'], $row['Nacionalidade'], $row['Nascimento'], $row['Morada'], $row['Telefone'], $row['TipoConta'], $row['Saldo'], $row['Imagem'], $row['ApiToken'], $row['NIF']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Import Users

    public function importUsers(Request $request)
    {

        $file = $request->avatar->getClientOriginalName();
        $fileName = pathinfo($file,PATHINFO_FILENAME);

        $newImgName = time() . '-' . $fileName . '.' . 
        $request->avatar->extension();

        $request->avatar->move('files',$newImgName);
        if (($h = fopen("files/".$newImgName, "r")) !== FALSE) 
        {
            // Convert each line into the local $data variable
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
            {		
                if ($data[0] != 'IdUser') {
                    // print_r($request->input());
                    $order = new Utilizador;

                    $order->IdUser=$data[0];
                    $order->Username=$data[1];
                    $order->Email=$data[2];
                    $order->Password=$data[3];
                    $order->PrimeiroNome=$data[4];
                    $order->UltimoNome=$data[5];
                    $order->Nacionalidade=$data[6];
                    $order->Nascimento=$data[7];
                    $order->Morada=$data[8];
                    $order->Telefone=$data[9];
                    $order->TipoConta=$data[10];
                    $order->Saldo=$data[11];
                    $order->imagem=$data[12];
                    $order->api_token=$data[13];
                    $order->NIF=$data[14];

                    $result = $order->save();

                    if ($data[10] == 'Senhorio') {
                        $orderS = new Senhorio;

                        $orderS->IdSenhorio=$data[0];
                        $orderS->IdUser=$data[0];
                        $orderS->Username=$data[1];

                        $resultS = $orderS->save();
                    }
                }
            }

            // Close the file
            fclose($h);
        }

        return redirect('utilizadoresFind');
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

        $data->IdPropriedade=$request->idpropriedade;
        $data->TipoPropriedade=$request->type;
        $data->Localizacao=$request->location;
        $data->Latitude=$request->latitude;
        $data->Longitude=$request->longitude;
        $data->AreaMetros=$request->area;
        $data->Preco=$request->price;
        $data->Descricao=$request->description;
        $data->OrientacaoSolar=$request->orientation;
        $data->NumeroQuartos=$request->rooms;
        $data->Lotacao=$request->capacity;
        $data->CasasBanho=$request->bathrooms;
        $data->EstadoConservacao=$request->state;
        $data->internetAcess=$request->internet;
        $data->limpeza=$request->cleaning;
        $data->faixaEtariaMin=$request->youngest;
        $data->faixaEtariaMax=$request->oldest;
        $data->generoMasc=$request->male;
        $data->generoFemin=$request->female;
        $data->aceitaFumadores=$request->smokers;
        $data->aceitaAnimais=$request->pets;
        $data->save();

        $propriedade = Propriedade::where('IdPropriedade','=' ,$idpropriedade)->get();
        
        return view('profile_propriedade',['data'=>$propriedade]);
    }

    // Delete Propriedade

    public function deletePropriedade($idpropriedade)
    {
        $propriedade = Propriedade::find($idpropriedade);
        $arrendamentos = Arrendamento::where('IdPropriedade', $idpropriedade)->get();
        // $extras = Extras::where('IdPropriedade', $idpropriedade)->get();
        $fotos = FotosPropriedades::where('IdPropriedade', $idpropriedade)->get();
        $indisponiveis = Indisponivel::where('IdPropriedade', $idpropriedade)->get();
        $inquilinos = Inquilino::where('IdPropriedade', $idpropriedade)->get();
        // $restricoes = Restricoes::where('IdPropriedade', $idpropriedade)->get();
        $ratings = Ratings::where('IdPropriedade', $idpropriedade)->get();
        // $pagamentos = Pagamentos::where('IdPropriedade', $idpropriedade)->get();
        $likes = Likes::where('IdPropriedade', $idpropriedade)->get();

        if ($arrendamentos != '[]') {
            foreach ($arrendamentos as $arrendamento) {
                $idarrendamento = Arrendamento::where('IdPropriedade', $idpropriedade)->value('IdArrendamento');
                $pagamentos = Pagamentos::where('IdArrendamento', $idarrendamento)->get();
                if ($pagamentos != '[]') {
                    foreach ($pagamentos as $pagamento) {
                        $pagamento->delete();
                    }
                }
                $arrendamento->delete();
            }
        }
        // if ($extras != '[]') {
        //     foreach ($extras as $extra) {
        //         $extra->delete();
        //     }
        // }
        if ($fotos != '[]') {
            foreach ($fotos as $foto) {
                $foto->delete();
            }
        }
        if ($indisponiveis != '[]') {
            foreach ($indisponiveis as $indisponivel) {
                $indisponivel->delete();
            }
        }
        if ($inquilinos != '[]') {
            foreach ($inquilinos as $inquilino) {
                $inquilino->delete();
            }
        }
        // if ($restricoes != '[]') {
        //     foreach ($restricoes as $restricao) {
        //         $restricao->delete();
        //     }
        // }
        if ($ratings != '[]') {
            foreach ($ratings as $rating) {
                $rating->delete();
            }
        }
        // if ($pagamentos != '[]') {
        //     foreach ($pagamentos as $pagamento) {
        //         $pagamento->delete();
        //     }
        // }
        if ($likes != '[]') {
            foreach ($likes as $like) {
                $like->delete();
            }
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

    // Export Users

    public function exportProperties(Request $request)
    {
        $fileName = 'properties.csv';
        $propriedades = Propriedade::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('IdPropriedade', 'IdSenhorio', 'TipoPropriedade', 'Localizacao', 'Latitude', 'Longitude', 'AreaMetros', 'Preco', 'Descricao', 'OrientacaoSolar', 'NumeroQuartos', 'Lotacao', 'CasasBanho', 'EstadoConservacao', 'InternetAccess', 'Limpeza', 'faixaEtariaMin', 'faixaEtariaMax', 'generoMasc', 'generoFemin', 'aceitaFumadores', 'aceitaAnimais');

        $callback = function() use($propriedades, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($propriedades as $propriedade) {
                $row['IdPropriedade'] = $propriedade->IdPropriedade;
                $row['IdSenhorio'] = $propriedade->IdSenhorio;
                $row['TipoPropriedade'] = $propriedade->TipoPropriedade;
                $row['Localizacao'] = $propriedade->Localizacao;
                $row['Latitude'] = $propriedade->Latitude;
                $row['Longitude'] = $propriedade->Longitude;
                $row['AreaMetros'] = $propriedade->AreaMetros;
                $row['Preco'] = $propriedade->Preco;
                $row['Descricao'] = $propriedade->Descricao;
                $row['OrientacaoSolar'] = $propriedade->OrientacaoSolar;
                $row['NumeroQuartos'] = $propriedade->NumeroQuartos;
                $row['Lotacao'] = $propriedade->Lotacao;
                $row['CasasBanho'] = $propriedade->CasasBanho;
                $row['EstadoConservacao'] = $propriedade->EstadoConservacao;
                $row['InternetAccess'] = $propriedade->internetAcess;
                $row['Limpeza'] = $propriedade->limpeza;
                $row['faixaEtariaMin'] = $propriedade->faixaEtariaMin;
                $row['faixaEtariaMax'] = $propriedade->faixaEtariaMax;
                $row['generoMasc'] = $propriedade->generoMasc;
                $row['generoFemin'] = $propriedade->generoFemin;
                $row['aceitaFumadores'] = $propriedade->aceitaFumadores;
                $row['aceitaAnimais'] = $propriedade->aceitaAnimais;

                fputcsv($file, array($row['IdPropriedade'], $row['IdSenhorio'], $row['TipoPropriedade'], $row['Localizacao'], $row['Latitude'], $row['Longitude'], $row['AreaMetros'], $row['Preco'], $row['Descricao'], $row['OrientacaoSolar'], $row['NumeroQuartos'], $row['Lotacao'], $row['CasasBanho'], $row['EstadoConservacao'], $row['InternetAccess'], $row['Limpeza'], $row['faixaEtariaMin'], $row['faixaEtariaMax'], $row['generoMasc'], $row['generoFemin'], $row['aceitaFumadores'], $row['aceitaAnimais']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Import Properties

    public function importProperties(Request $request)
    {
        $file = $request->avatar->getClientOriginalName();
        $fileName = pathinfo($file,PATHINFO_FILENAME);

        $newImgName = time() . '-' . $fileName . '.' . 
        $request->avatar->extension();

        $request->avatar->move('files',$newImgName);
        if (($h = fopen("files/".$newImgName, "r")) !== FALSE) 
        {
            // Convert each line into the local $data variable
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
            {		
                if ($data[0] != 'IdPropriedade') {
                    // print_r($request->input());
                    $order = new Propriedade;

                    $order->IdPropriedade=$data[0];
                    $order->IdSenhorio=$data[1];
                    $order->TipoPropriedade=$data[2];
                    $order->Localizacao=$data[3];
                    $order->Latitude=$data[4];
                    $order->Longitude=$data[5];
                    $order->AreaMetros=$data[6];
                    $order->Preco=$data[7];
                    $order->Descricao=$data[8];
                    $order->OrientacaoSolar=$data[9];
                    $order->NumeroQuartos=$data[10];
                    $order->Lotacao=$data[11];
                    $order->CasasBanho=$data[12];
                    $order->EstadoConservacao=$data[13];
                    $order->internetAcess=$data[14];
                    $order->limpeza=$data[15];
                    $order->faixaEtariaMin=$data[16];
                    $order->faixaEtariaMax=$data[17];
                    $order->generoMasc=$data[18];
                    $order->generoFemin=$data[19];
                    $order->aceitaFumadores=$data[20];
                    $order->aceitaAnimais=$data[21];

                    $result = $order->save();
                }
            }

            // Close the file
            fclose($h);
        }

        return redirect('propriedadesFind');
    }


    // ###################################################### Establishments ######################################################


    // Show Establishments

    public function establishments()
    {
        return view('create_establishments');
    }

    // Create Establishment 

    public function createEstablishment(Request $request)
    {
        $tipo = $request->input('type');
        if ($tipo == "") {
            return redirect('createEstablishment');  
        }
        $request->input();
        $order = new Local;
        $order->Tipo=$request->type;
        $order->Nome=$request->name;
        $order->Descricao=$request->description;
        $order->Latitude=$request->latitude;
        $order->Longitude=$request->longitude;

        $result = $order->save();

        return redirect('findEstablishment');  
    }

    // Find Establishment

    public function findEstablishment(Request $request)
    {
        $search_data1 = $request->input('tipo');

        if ($search_data1 != ""){
            $locais = Local::where('Tipo', $search_data1)
            ->get();
        } else {
            $locais = Local::all();
        }

        return view('find_establishments',compact('locais'));
    }

    // Show Establishment

    public function establishmentProfile($idestablishment)
    {
        $local = Local::where('Id','=' ,$idestablishment)->get();
        
        return view('profile_establishment',['data'=>$local]);
    }

    // Update Establishment

    public function updateEstablishment(Request $request, $idestablishment)
    {
        $data = Local::find($idestablishment);

        $data->Tipo=$request->type;
        $data->Nome=$request->name;
        $data->Latitude=$request->latitude;
        $data->Longitude=$request->longitude;
        $data->Descricao=$request->description;
        $data->save();
        
        $local = Local::where('Id','=' , $idestablishment)->get();

        return view('profile_establishment',['data'=>$local]);
    }

    // Delete Establishment

    public function deleteEstablishment($idestablishment)
    {
        $local = Local::find($idestablishment);
        $local->delete();
        
        return redirect('findEstablishment');
    }
     
}


?>