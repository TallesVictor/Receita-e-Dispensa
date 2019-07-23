<html>

<head>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/html2canvas.js"></script>
    <script type="text/javascript" src="../js/jquery.plugin.html2canvas.js"></script>

    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript">
	window.setTimeout(function() {
		document.getElementById("top").click();
	}, 0000);
</script>
</head>

<body>


    <form method="POST" enctype="multipart/form-data" action="save.php" id="myForm">
        <input type="hidden" name="img_val" id="img_val" value="" />
    </form>
    <button type="submit" id="top" onclick="capture();"> aaa</button>

    <div id="target">
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Alimento</th>
                            <th scope="col">Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qtd = $_POST['quantidade'];
                        for ($i = 0; $i < $qtd; $i++) {
                            $nomeIngrediente = 'nomeIngrediente' . ($i + 1);
                            $quantidadeIngrediente = 'quantidade' . ($i + 1);
                            $ingrediente[$i] = $_POST[$nomeIngrediente];
                            $qtdIngrediente[$i] = $_POST[$quantidadeIngrediente];
                            if($qtdIngrediente[$i]>=0){
                            echo '<tr>
                                    <td scope="row">' . $ingrediente[$i] . '</td>
                                    <td>' . $qtdIngrediente[$i] . '</td>
                            </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
    </div>

</body>
</html>
<script type="text/javascript">
	function capture() {
		$('#target').html2canvas({
			onrendered: function(canvas) {
				//Set hidden field's value to image data (base-64 string)
				$('#img_val').val(canvas.toDataURL("image/png"));
				//Submit the form manually
				document.getElementById("myForm").submit();
			}
		});
	}
</script>