

<html>
    <head>
        <meta charset="UTF-8">

        <!-- estilo -->
      
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>

    <body>
        <main>  
            <form class="form-horizontal" action="" method="POST">
                <fieldset>

                <label class="col-md-1 control-label" for="receber">nome</label>
                <input type="text" name="receber" id="receber" value="<?php echo $_POST["nome"]?>">

                <label class="col-md-2 control label for singlebutton">
                    <button type="submit" class="btn btn-success">Enviar dados</button>
                </label>
                </fieldset>

<?php 
  print_r($_POST);
?>

            </form>
            
            
        </main>

       
    </body>
</html>
