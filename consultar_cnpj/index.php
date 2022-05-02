<!doctype html>
<html>

<head>
    <meta charset="UTF-8">

    <!-- estilo -->


</head>

<body>
    <label>Cnpj</label>
    <input type="text" onblur="checkCnpj(this.value)" data-mask="00.000.000/0000-00">

    <label>Razão Social</label>
    <input type="text" id="razaosocial">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
    function checkCnpj(cnpj) {
        $.ajax({
            'url': 'https://www.receitaws.com.br/v1/cnpj/' + cnpj.replace(/[^0-9]/g, ''),
            'type': "GET",
            'dataType': 'jsonp',
            'success': function(data) {
                if (data.nome == undefined) {
                    alert(data.status + '' + data.message)
                } else {
                    document.getElementById('razaosocial').value = data.nome;
                    document.getElementById('razaosocial').value = data.nome;
                }
            }
        })
    }
    </script>
</body>

</html>