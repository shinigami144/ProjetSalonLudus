<?php
    require_once('db.php');
    session_start();

    $attente = 1;
    $position = 15;
?>

<body>
<nav class="nav">
    <div id="nav1"><a href="#">Salons</a></div>
    <div id="nav2"><a href="#">Stands</a></div>
    <div id="nav3"><a href="#">Profil</a></div>
</nav>
<div id="profilePic" class="card" >
    <?php
        // Affichage din
        if(isset($_SESSION['mail'])){
            $sql = $conn->prepare('SELECT photoUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();

            $result = $sql->fetchAll();

            foreach ($result as $user) {
                echo '<img id="img" src="./css/'.$user['photoUtilisateur'].'.png" >';
            }

          }


        // Affichage dinamique du nom + prenom
       if(isset($_SESSION['mail'])){
            $sql = $conn->prepare('SELECT nomUtilisateur, prenomUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();

            $result = $sql->fetchAll();

            foreach ($result as $user) {
                echo "<p>".$user['prenomUtilisateur']." ".$user['nomUtilisateur']."</p>";
            }

          }
    ?>

    <?php // condion d'etre dans une liste d'attente
    if($attente == 1){ ?>
        <div id="attente">
            <canvas id='canvas' style='height:102;width:102;' ></canvas>
        </div>
    <?php } 
    ?>
    
</div>

<img hidden="true" src="css/groupe.png" id="groupe" />
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

    var seconds = 1;
    var min = 5;
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
        ctx.clearRect(0, 0,canvas.width ,canvas.height);
        var img = document.getElementById("groupe");
        img.height=100;
        img.width=100;
        
        ctx.drawImage(img,4,0)
        
        ctx.beginPath();
        ctx.fillStyle="#000000"
        ctx.arc(35, 115, 35, 0, 2 * Math.PI);
        ctx.fill();
        
        ctx.fillStyle="#ff0000"
        ctx.font = '38px Verdana';

        
        
        ctx.fillText('<?php echo $position ?>',5,135);
    }
</script>

</body>
