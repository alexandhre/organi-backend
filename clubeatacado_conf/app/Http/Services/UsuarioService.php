<?php

namespace App\Http\Services;

use App\CategoriaEmpresa;
use App\TipoNegocio;
use App\Comprador;
use App\Produtor;
use App\RepresentanteLegal;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UsuarioService
{  
   //generalizar esses metodos
   public function recuperarDadosUsuario($idComprador)
   { 
      return Comprador::recuperarDadosComprador($idComprador);
   }  

   public function recuperarTipoNegocioEmpresa()
   { 
      return TipoNegocio::listarTipos();
   }  

   public function recuperarCategoriaEmpresa()
   { 
      return CategoriaEmpresa::listarCategorias();
   }  

   //generalizar esses metodos
   public function recuperarDadosProdutor($idComprador)
   { 
      return Produtor::recuperarDados($idComprador);
   }  

   public function validarDadosUsuario(Request $request)
   {  
      
      $validator = Validator::make($request->all(), [
         'razaoSocial' => 'max:100',
         'nomeFantasia' => 'max:100',
         'telefone' => 'max:16',
         'telefoneComercial' => 'max:16',
         'qtdEmpregados' => 'integer',
         'cnpj' => ['min:18 ','max:18', Rule::unique('TB_PRODUTOR', 'NR_CNPJ')->ignore(session()->all()['id'])],                  
         'representanteLegal' => 'max:250',
         'RGRepresentanteLegal' => 'max:25',
         'CPFRepresentante' => 'max:25',
         'endereco' => 'max:100',
         'nrEndereco' => 'max:10',
         'complemento' => 'max:100',
         'pontoReferencia' => 'max:100',
         'cep' => 'max:11',
         'agricultor' => 'max:500',
         'territorio' => 'max:100',
         'tamanhoFabrica' => 'max:100',
         'declaracaoFornecedor' => 'max:100',
         'pronafDaf' => 'max:100',
         'categoriaEmpresa' => 'integer',
         'tipoNegocio' => 'integer',
         'id_cidade' => 'integer'
      ]);     

      return $validator;          
   }

   public function atualizarDadosProdutor($dados)
   {  
      return Produtor::atualizarDadosProdutor($dados);          
   }

   public function atualizarRepresentanteLegal($dados, $idRepresentanteLegal)
   {  
      return RepresentanteLegal::atualizarRepresentanteLegal($dados, $idRepresentanteLegal);          
   }

   public function validarDadosRepresentanteLegal(Request $request)
   {  
      $validator = Validator::make($request->all(), [
         'representanteLegal' => 'max:250',
         'RGRepresentanteLegal' => 'max:25',
         'EnderecoRepresentanteLegal' => 'max:500',
         'CPFRepresentante' => 'max:25'
      ]);

      return $validator;          
   }

   public function cadastrarRepresentanteLegal($dados)
   {  
      return RepresentanteLegal::cadastrarRepresentanteLegal($dados);          
   }

   public function recuperarRepresentanteLegal($idProdutor)
   {  
      return RepresentanteLegal::recuperarRepresentanteLegal($idProdutor);          
   }
}
