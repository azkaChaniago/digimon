<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<form action="">
    <select name="kode_marketing" id="category">
        <option value="">--- PILIH CANVASSER ---</option>
        <?php foreach($marketing as $can) : ?>
            <option value="<?= $can->kode_marketing ?>" ><?= $can->nama_marketing ?></option>
        <?php endforeach; ?>
    </select>

    <select name="id_outlet" id="sub_category">
        <option value="">--- PILIH OUTLET ---</option>								
    </select>
</form>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    // const marketing = JSON.parse('<?= json_encode($marketing) ?>');
    // const outlet = JSON.parse('<?= json_encode($outlet) ?>');
    $(document).ready(function(){
         $('#category').change(function(){ 
            let id = $(this).val();
            $.ajax({
                url : "<?= site_url('indirect/historiorder/getoutlet');?>",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){                         
                    let options = `<option value=''> -- PILIH OUTLET -- </option>`;
                    let i;
                    for (i=0; i<data.length; i++){
                        options += `<option value='${data[i].id_outlet}'>${data[i].nama_outlet}</option>`;
                    }
                    console.log(options);
                    $('#sub_category').html(options); 
                    console.log($('#sub_category'));
                }
            });
            return false;
        }); 
         
    });
</script>
</body>
</html>