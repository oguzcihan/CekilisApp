<html>
	<head>
		<title>Çekiliş Scripti</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<link rel="stylesheet" href="stil.css" />
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	</head>
	<body>
		<div class="ic">
			<form id="update" method="post"> 
				Kazanan sayısı<br/><input name="kazanacak_sayisi" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="number" /><br/><br/>
				<span id="unique"><input name="unique" type="checkbox" style="width:22px;" unchecked>Tekrar eden katılımcılar çıkarılsın mı ?<br></span>
				<small id="help-unique"><i>Eğer bir katılımcının birden fazla çekiliş hakkı varsa bu seçeneği işaretlemeyin. Katılımcının adı ne kadar çok yazılmışsa o kadar kazanma hakkı olur.</i></small><br>
				<span id="multi"><input name="multi" type="checkbox" style="width:22px;" unchecked>Katılımcılar birden fazla hediye kazansın mı ?<br></span>
				<small id="help-multi"><i>Bir katılımcının birden fazla hediye kazanmasını istiyorsanız bu seçeneği işaretleyin.</i></small><br>
				Katılımcılar(Alt alta girin)<br/>

				<textarea name="katilimcilar"></textarea><br/>
				<input id="check_ok" class="buton" type="button" value="Başlat" />
			</form>
        
			<div id="result">
			</div>
		</div>
		<center>
		<a href="#">by OğuzCihan</a></br>
	</center>
	</body>
</html>


<script>
$('#check_ok').click(function(){
	$('#result').html('<img style="width:20px; height:20px;" src="spiffy.gif" />');		
	$.ajax({ 
		type:'POST', 
		url:'jPost.php',
		data:$("#update").serialize(), 
		success:function(dt){
			$("#result").html(dt); 
		}
	});
});

$("#unique").on({
    mouseenter: function () {
        $("#help-unique").toggle(200,function(){});
    },
    mouseleave: function () {
        $("#help-unique").toggle(10,function(){});
    }
});
$("#multi").on({
    mouseenter: function () {
        $("#help-multi").toggle(200,function(){});
    },
    mouseleave: function () {
        $("#help-multi").toggle(10,function(){});
    }
});
</script>