<?php
    function real_format($valor) {
        $valor  = number_format($valor,2,",",".");
        return "R$ " . $valor;
    }

    function porcent_format($valor) {
      return $valor . " % ";
  }


    function dia_format($dias){
       return $dias . " dias";
    }

    function formatCnpjCpf($value)
    {
      $cnpj_cpf = preg_replace("/\D/", '', $value);
      
      if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
      } 
      
      return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }


    function formatardata($value){
      $value = date("Y-m-d",strtotime($value));
      return $value;
    }

    function formatardataB($value){
      $value = date("d/m/Y",strtotime($value));
      return $value;
    
   }

   

?>











