<script type="text/javascript">
    $(document).ready(function ($) {
      $('#cnpj').mask('00.000.000/0000-00', { reverse: true });
      $('#telefone').mask('(99) 99999-9999');
      $('#telefoneComercial').mask('(99) 9999-9999', { reverse: true });
      $('#dtFundacaoNascimento').mask('00/00/0000', { reverse: true });
      $('#RGRepresentanteLegal').mask('99.999.999-99', { reverse: true });
      $('#CPFRepresentante').mask('999.999.999-999', { reverse: true });
      $('#cep').mask('00000-000', { reverse: true });  
      $('#qtdEmpregados').mask('000000000000000000000000000000', { reverse: true });                 
    });
</script>