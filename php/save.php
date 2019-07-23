<?php
//Get the base-64 string from data
$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);

//Decode the string
$unencodedData=base64_decode($filteredData);

//Save the image
file_put_contents('img.png', $unencodedData);
?>
<html>
<body bgcolor="black">
<script type="text/javascript">
	window.setTimeout(function() {
		document.getElementById("top").click();
    }, 0000);
    
    
    window.setTimeout(function() {
		document.getElementById("top1").click();
    }, 200);
    function teste(){
        window.location.href ='img.png';
    }
</script>
<button style="color:black; background-color:black;  border-width: 0px;"><a href="baixar.php?arquivo=img.png" id="top" style="color:black; background-color:black">Baixar Arquivo</a></button>
<button id="top1" onclick="teste()" style="color:black; background-color:black;  border-width: 0px;" >Abrir Pagina</button>
</body>
</html>
<?php
 //header('Location: img.png');
?>