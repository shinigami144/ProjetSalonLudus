<?php
$attente = 1;
$position = 15;
?>
<body>

<div id="profilePic" class="card" >
    <img src="../SiepProject/css/profile.png" >
    <h1>Julie Morand</h1>
    <?php // condion d'etre dans une liste d'attente
    if($attente == 1){ ?>
        <canvas id='canvas' style='width:100%;'></canvas><p><button>Retour a la file d'attente</button></p>
    <?php } 
    ?>
    
</div>

<!--faut bd ou atre moyen d'avoir une variable pour la file d'attente-->
<!-- script pour les 5 minutes de file d'attente -->
    <script>
    // Faut check cette condition pendant que la page est actve sans recharger la page
if((<?php echo $attente; ?> == 1)&&(<?php echo $position; ?> ==1)){

    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    ctx.fillStyle = '#000000';
    ctx.fillRect(0, 0,canvas.width ,canvas.height);
    ctx.clearRect(0, 0,canvas.width ,canvas.height);

    ctx.font = '18px Verdana';

    ctx.fillText('C\'est votre tour',100,50);

    ctx.font = '38px Verdana';

    var seconds = 5;
    var min = 0;
    var a=setInterval(function() {
    ctx.clearRect(0, 0,canvas.width ,canvas.height);

    ctx.font = '18px Verdana';

    ctx.fillText('C\'est votre tour',80,50);

    ctx.font = '38px Verdana';
    ctx.fillText(min + ':' +seconds--,100,100);
        if ((min >= 1)&&(seconds <= 0)){
            min--;
            seconds=59;;
        }
        if ((min == 0)&&(seconds == 0)){
            ctx.clearRect(0, 0,canvas.width ,canvas.height);
            ctx.font = '38px Verdana';
            ctx.fillText('0' + ':' +'0',100,100);
            window.alert('Vous avez été éjecté de la liste d\'attente');
            clearInterval(a);
        } 
    }, 1000);
    }
    </script>   
<!-- Si pas encore le tour de l'utilisateur, faire un script qui lui montre sa place dans la file -->
<script>
    // Faut check cette condition pendant que la page est actve sans recharger la page
    if((<?php echo $position ?> > 1)&&(<?php echo $attente ?> == 1)){
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#000000';
        ctx.fillRect(0, 0,canvas.width ,canvas.height);
        ctx.clearRect(0, 0,canvas.width ,canvas.height);

        ctx.font = '18px Verdana';

        ctx.fillText('Vous êtes en position <?php echo $position ?>',40,50);
    }
</script>
</body>
