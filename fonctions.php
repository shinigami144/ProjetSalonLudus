<?php
    function AfficheImageProfil ()
    {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT photoUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo '<img src="css/'.$user['photoUtilisateur'].'.png"  width="200" height="200">';
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }      
    }

    function AfficheNomPrenom ()
    {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT nomUtilisateur, prenomUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();

            foreach ($result as $user) {
                echo "<h1>".$user['prenomUtilisateur']." ".$user['nomUtilisateur']."</h1>";
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    }

    function AfficheOptionSelectPays()
    {
        include('db.php'); 
        try {
          $sql = $conn->prepare('SELECT nom_fr_fr, idPays FROM pays');
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo '<option value="'.$user['idPays'].'">'.$user['nom_fr_fr'].' </option>';
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
    }

    function RecupIdPays($nomPays)
    {
        return $nomPays;
    }

    function SupprimerUnUtilisateur($mail)
    {
        include('db.php'); 
        try {
          $sql = "DELETE FROM Utilisateur WHERE mailUtilisateur = '".$mail."'";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        session_destroy();
      }
    
      function AfficheNom ()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT nomUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['nomUtilisateur'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      function AffichePrenom ()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT prenomUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['prenomUtilisateur'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      function AfficheAdresse ()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT adresseUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['adresseUtilisateur'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }
      
      function AfficheCodePostal()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT codePostalUtilsateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['codePostalUtilsateur'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      function AfficheVille()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT villeUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['villeUtilisateur'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      function AffichePays()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT idPaysUtilsateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                $idPays = $user['idPaysUtilsateur'];
            }

            $sql = $conn->prepare('SELECT nom_fr_fr FROM pays WHERE idPays = "'.$idPays.'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['nom_fr_fr'];
            }

          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      function AfficheTelephone()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT telUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['telUtilisateur'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      // Cette fonction retire la validation de l'email si celle ci est modifié
      function UpdateEmail($nouveauMail)
      {
        include('db.php'); 
        if ($nouveauMail != $_SESSION['mail']) // Si ce n'est pas la meme que celle que t'utilisateur a déjà 
        {
          
          try {
            $sql = $conn->prepare('SELECT mailUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_POST['email'].'"');
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result == 0) // Si elle n'est pas déjà utilisé alors
            {
              try {
                $sql = 'UPDATE `utilisateur` SET `mailUtilisateur` = "'.$nouveauMail.'", `verificationUtilisateur` = "0" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $_SESSION['mail'] = $nouveauMail;
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
            }
            else
            {
                echo "Adresse mail déjà utilisé.";
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
        }
      }

      function UpdateName($nouveauNom)
      {
        include('db.php'); 
        try {
          $sql = 'UPDATE `utilisateur` SET `nomUtilisateur` = "'.$nouveauNom.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      function UpdateFirstname($nouveauPrenom)
      {
        include('db.php'); 
        try {
          $sql = 'UPDATE `utilisateur` SET `prenomUtilisateur` = "'.$nouveauPrenom.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      function UpdateAdresse($nouvelleAdresse)
      {
        include('db.php'); 
        try {
          $sql = 'UPDATE `utilisateur` SET `adresseUtilisateur` = "'.$nouvelleAdresse.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      function UpdatePostalCode($nouveauCodePostal)
      {
        include('db.php'); 
        try {
          $sql = 'UPDATE `utilisateur` SET `codePostalUtilsateur` = "'.$nouveauCodePostal.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      function UpdateCity($nouvelleVille)
      {
        include('db.php'); 
        try {
          $sql = 'UPDATE `utilisateur` SET `villeUtilisateur` = "'.$nouvelleVille.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      function UpdateCountry($nouveauPays)
      {
        include('db.php'); 
        $idPays = RecupIdPays($nouveauPays);
        try {
          $sql = 'UPDATE `utilisateur` SET `idPaysUtilsateur` = "'.$idPays.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      // return le mdp crypte
      function GetMdp()
      {
        include('db.php'); 
        try {
          $sql = $conn->prepare('SELECT mdpUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              return $user['prenomUtilisateur'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      // prend en parametre le nouveau mdp
      function SetMdp($nouveauMdp)
      {
        include('db.php'); 
        try {
          $nouveauMdpCrypt = password_hash($nouveauMdp,PASSWORD_DEFAULT);
          $sql = 'UPDATE `utilisateur` SET `mdpUtilisateur` = "'.$nouveauMdpCrypt.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
          $stmt = $conn->prepare($sql);
          $stmt->execute();

        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

      function AfficheVillesDesSalons ()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT DISTINCT `villeSalon` FROM `salon`');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo '<option value="'.$user['villeSalon'].'">'.$user['villeSalon'].'</option>';
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

      // Affichage de la liste des salons
      function AfficheSalon()
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT * FROM `salon` WHERE `idSuperAdmin` IS NOT NULL');
            $sql->execute();
            $result = $sql->fetchAll();
            return json_encode($result);
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }
      // ---------------------- Filtre de la liste des salons -----------------------------
      function FiltreSalonVille($ville)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `villeSalon` = "'.$ville.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonDateDebut($dateDebut)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateDebutSalon` = "'.$dateDebut.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonDateFin($dateFin)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateFinSalon` = "'.$dateFin.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonNom($nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `nomSalon` = "'.$nom.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonVilleEtDateDebut($ville,$dateDebut)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `villeSalon` = "'.$ville.'" AND `dateDebutSalon` = "'.$dateDebut.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonVilleEtDateFin($ville,$dateFin)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `villeSalon` = "'.$ville.'" AND `dateFinSalon` = "'.$dateFin.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonVilleEtNom($ville,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `villeSalon` = "'.$ville.'" AND `nomSalon` = "'.$nom.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      
      function FiltreSalonDateDebutDateFin($dateDebut,$dateFin)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateDebutSalon` = "'.$dateDebut.'" AND `dateFinSalon` = "'.$dateFin.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonDateDebutNom($dateDebut,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateDebutSalon` = "'.$dateDebut.'" AND `nomSalon` = "'.$nom.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonDateFinNom($dateFin,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateFinSalon` = "'.$dateFin.'" AND `nomSalon` = "'.$nom.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      
      function FiltreSalonVilleDateDebutDateFin($ville,$dateDebut,$dateFin)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateFinSalon` = "'.$dateFin.'" AND `dateDebutSalon` = "'.$dateDebut.'" AND `villeSalon` = "'.$ville.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      
      function FiltreSalonVilleDateDebutNom($ville,$dateDebut,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `nomSalon` = "'.$nom.'" AND `dateDebutSalon` = "'.$dateDebut.'" AND `villeSalon` = "'.$ville.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      
      function FiltreSalonVilleDateFinNom($ville,$dateFin,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `nomSalon` = "'.$nom.'" AND `dateFinSalon` = "'.$dateFin.'" AND `villeSalon` = "'.$ville.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function FiltreSalonDateDebutDateFinNom($dateDebut,$dateFin,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateDebutSalon` = "'.$dateDebut.'" AND `dateFinSalon` = "'.$dateFin.'" AND `villeSalon` = "'.$ville.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      
      function FiltreSalonVilleDateDebutDateFinNom($ville,$dateDebut,$dateFin,$nom)
      {
        include('db.php');
        try {
          $sql = $conn->prepare('SELECT * FROM `salon` WHERE `dateDebutSalon` = "'.$dateDebut.'" AND `dateFinSalon` = "'.$dateFin.'" AND `villeSalon` = "'.$ville.'" AND `idSuperAdmin` IS NOT NULL');
          $sql->execute();
          $result = $sql->fetchAll();
          return json_encode($result);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      // ------------------- FIN Filtre de la liste des salons -----------------------------

      // Creation de salon pas encore accepter par les admin
      function creeSalon($titre,$dateDebutContact,$dateFinContact,$horaireOuverture,$horaireFermeture,$localisationContact,$description,$img)
      {
        include('db.php');
        try {
          $sql = "INSERT INTO `salon` (`idSalon`, `nomSalon`, `imageSalon`, `pitchSalon`, `descriptionSalon`, `dateDebutSalon`, `dateFinSalon`, `ouvertureSalon`, `fermetureSalon`, `villeSalon`, `regionSalon`, `idPaysSalon`, `stockInfoSalon`, `idSuperAdmin`) 
          VALUES (NULL, '".$titre."', '".$img."', NULL, '".$description."', '".$dateDebutContact."', '".$dateFinContact."', '".$horaireOuverture."', '".$horaireFermeture."', '".$localisationContact."', NULL, NULL, '1', NULL)";
            $conn->exec($sql);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        // Recupère l'id du salon qu'on vient de crée
        try {
          $sql = $conn->prepare('SELECT idSalon FROM `salon` WHERE `dateDebutSalon` = "'.$dateDebutContact.'" AND `dateFinSalon` = "'.$dateFinContact.'" AND `descriptionSalon` = "'.$description.'" AND `nomSalon` = "'.$titre.'" AND `villeSalon` = "'.$localisationContact.'"');
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
            $idSalon = $user['idSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

        // Recupère l'id de l'utilisateur 
        try {
          $sql = $conn->prepare('SELECT idUtilisateur FROM Utilisateur WHERE mailUtilisateur = "'.$_SESSION['mail'].'"');
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
            $idUtilisateur = $user['idUtilisateur'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

        // Defini le createur/admin du salon
        try {
          $sql = "INSERT INTO `stockageinfosalon` (`idUtilisateur`, `idSalon`) VALUES ('".$idUtilisateur."', '".$idSalon."');";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

        // Defini les droits du createur/admin 
        try {
          $sql = "INSERT INTO `adminsalon` (`idUtilisateur`, `idSalon`, `droitASalon`) VALUES ('".$idUtilisateur."', '".$idSalon."', '1');";
          $conn->exec($sql);
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        return $idSalon;
      }

      // ---------------------- GESTION DES MAIL DE DEMANDE DE CREATION DE SALON + REFUE OU ACCEPATION DE CELUI CI ------------------------
      function sendMailDemandeCreationSalon($titre,$dateDebutContact,$dateFinContact,$horaireOuverture,$horaireFermeture,$localisationContact,$description,$information,$image,$idSalon)
      {
        include('db.php');
        $entetes = 'Content-Type: text/html; charset="UTF-8"'."n";
        try {
          $sql = $conn->prepare('SELECT mailSuperAdmin FROM `superadmin`');
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
            if (mail($user['mailSuperAdmin'], "Demande de creation de salon", '<html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Confirmation Salon</title>
                <style>
                    #information {
                        margin-top: 30px;
                        padding : 12px;
                        width: calc(100% - 24px);
                        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
                        border-radius: 10px;
                        margin-bottom: 50px;
                    }
            
                    #information > div {
                        width: 100%;
                        height: 200px;
                        text-align: center;
                        display: flex;
                        align-items: center;
                    }
            
                    #information > div > div {
                        width: calc(100% - 200px);
                    }
            
                    #information > div img {
                        float: left;
                        width: 200px;
                        height: 200px;
                        margin-right: 20px;
                    }
            
                    #information > div h1 {
                        text-decoration: underline;
                    }
            
                    #information > article {
                        width: calc(100% - 60px);
                        padding-left: 30px;
                        padding-right: 30px;
                    }
            
                    #formContainer button {
                        height: 40px;
                        font-size: 20px;
                    }
                </style>
            </head>
            <body>
                <div id="information"><!-- information (à completer en php)-->
                    <div>
                        <img src="'.$image.'">
                        <div>
                            <h1>'.$titre.'</h1>
                            <p>Organisé par : '.$_SESSION['mail'].'</p>
                        </div>     
                    </div>
                    <article>
                        <h2>Information :</h2>
                        <p>du '.$dateDebutContact.' au '.$dateFinContact.'</p>
                        <p>de '.$horaireOuverture.' à '.$horaireFermeture.'</p>
                        <p> A '.$localisationContact.'</p>
                        <p>Description : '.$description.'</p>
                        <p>Informations supplémentaire : '.$information.'</p>
                    </article>
                </div>
                <div id="formContainer">
                    <a href="http://localhost/projetsalon/MesTest/accepterSalon.php?id='.$idSalon.'"><button>Accepter le salon</button></a>
                    <a href="http://localhost/projetsalon/MesTest/refuserSalon.php?id='.$idSalon.'"><button>Refuser le salon</button></a>
                </div>
            </body>
            </html>',$entetes)) // Envoi du message
            {
                echo "Demande bien envoyé.";
            }
            else // Non envoyé
            {
                echo "Problème.";
            }
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }

      function accepterSalon($idSalon)
      {
        include('db.php'); 
        try {
          $sql = 'UPDATE `salon` SET `idSuperAdmin` = "1" WHERE `salon`.`idSalon` = '.$idSalon;
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
        try {
          $sql = $conn->prepare('SELECT `idUtilisateur` FROM `adminsalon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
            $sql = $conn->prepare('SELECT `mailUtilisateur` FROM `utilisateur` WHERE `idUtilisateur` = '.$user['idUtilisateur']);
            $sql->execute();
            $result2 = $sql->fetchAll();
            foreach ($result2 as $mail) {
              if (mail($mail['mailUtilisateur'], "Retour sur votre demande de creation de salon", "Votre salon à été accepté.")) // Envoi du message
              {
                echo "Email de validation envoyé.";
              }
              else // Non envoyé
              {
                echo "Problème lors de l'envoie de l'email de validation.";
              }
            }
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

      }

      function refuserSalon($idSalon)
      {
        include('db.php'); 

        try {
          $sql = $conn->prepare('SELECT `idUtilisateur` FROM `adminsalon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
            $sql = $conn->prepare('SELECT `mailUtilisateur` FROM `utilisateur` WHERE `idUtilisateur` = '.$user['idUtilisateur']);
            $sql->execute();
            $result2 = $sql->fetchAll();
            foreach ($result2 as $mail) {
              if (mail($mail['mailUtilisateur'], "Retour sur votre demande de creation de salon", "Votre salon à été refusé.")) // Envoi du message
              {
                echo "Email de refue envoyé.";
              }
              else // Non envoyé
              {
                echo "Problème lors de l'envoie de l'email de refue.";
              }
            }
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

        try {
          $sql = 'DELETE FROM `adminsalon` WHERE `adminsalon`.`idSalon` = '.$idSalon;
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }

        try {
          $sql = 'DELETE FROM `stockageinfosalon` WHERE `stockageinfosalon`.`idSalon` = '.$idSalon;
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }

        try {
          $sql = 'DELETE FROM `salon` WHERE `salon`.`idSalon` = '.$idSalon;
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        } catch(PDOException $e) {
          echo $sql . "<br>" . $e->getMessage();
        }
      }
      // -------------------- GESTION DES MAIL DE DEMANDE DE CREATION DE SALON + REFUE OU ACCEPATION DE CELUI CI FIN ----------------------

      function AfficheNomSalon($idSalon)
      {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT `nomSalon` FROM `salon` WHERE `idSalon` = "'.$idSalon.'"');
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['nomSalon'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
      }

    function AfficheNomPrenomCreateurSalon($idSalon)
    {
      include('db.php'); 
      try {
        $sql = $conn->prepare('SELECT `idUtilisateur` FROM `adminsalon` WHERE `idSalon` = '.$idSalon);
        $sql->execute();
        $result = $sql->fetchAll();
        foreach ($result as $user) {
          $sql = $conn->prepare('SELECT nomUtilisateur, prenomUtilisateur FROM Utilisateur WHERE idUtilisateur = '.$user['idUtilisateur']);
          $sql->execute();
          $result2 = $sql->fetchAll();
          foreach ($result2 as $info) {
            echo $info['prenomUtilisateur']." ".$info['nomUtilisateur'];
          }
        }
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    function AfficheImageSalon($idSalon)
    {
        include('db.php'); 
        try {
            $sql = $conn->prepare('SELECT `imageSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
            $sql->execute();
            $result = $sql->fetchAll();
            foreach ($result as $user) {
                echo $user['imageSalon'];
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }      
    }

    function AfficheDateDebutSalon($idSalon)
    {
      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT `dateDebutSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo $user['dateDebutSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
    }

    function AfficheDateFinSalon($idSalon)
    {
      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT `dateFinSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo $user['dateFinSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
    }

    function AfficheOuvertureSalon($idSalon)
    {
      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT `ouvertureSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo $user['ouvertureSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
    }

    function AfficheFermetureSalon($idSalon)
    {
      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT `fermetureSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo $user['fermetureSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
    }

    function AfficheLocalisationSalon($idSalon)
    {
      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT `villeSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo $user['villeSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
    }

    function AfficheDescriptionSalon($idSalon)
    {
      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT `descriptionSalon` FROM `salon` WHERE `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo $user['descriptionSalon'];
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
    }

    function EstAdmin($idSalon)
    {
      include('db.php'); 
      try {
        $sql = $conn->prepare('SELECT idUtilisateur FROM `utilisateur` WHERE `mailUtilisateur` = "'.$_SESSION['mail'].'"');
        $sql->execute();
        $result = $sql->fetchAll();
        foreach ($result as $user) {
            $idUtili = $user['idUtilisateur'];
        }
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }      

      include('db.php'); 
      try {
          $sql = $conn->prepare('SELECT * FROM `adminsalon` WHERE `idUtilisateur` = '.$idUtili.' AND `idSalon` = '.$idSalon);
          $sql->execute();
          $result = $sql->fetchAll();
          foreach ($result as $user) {
              echo 1;
              return;
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }      
        echo 0;
    }
    // ----------------------------- Fonction faite par Aymeric ----------------------------
    function SupprimerUnSalon($idSalon)
    {
      include('db.php'); 

      try {
        $sql = $conn->prepare('SELECT `idUtilisateur` FROM `adminsalon` WHERE `idSalon` = '.$idSalon);
        $sql->execute();
        $result = $sql->fetchAll();
        foreach ($result as $user) {
          $sql = $conn->prepare('SELECT `mailUtilisateur` FROM `utilisateur` WHERE `idUtilisateur` = '.$user['idUtilisateur']);
          $sql->execute();
          $result2 = $sql->fetchAll();
          foreach ($result2 as $mail) {
            if (mail($mail['mailUtilisateur'], "Votre salon à été supprimer", "Votre salon à été supprimer.")) // Envoi du message
            {
              echo "Email de suppression de salon envoyé.";
            }
            else // Non envoyé
            {
              echo "Problème lors de l'envoie de l'email de suppression de salon";
            }
          }
        }
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

      try {
        $sql = 'DELETE FROM `adminsalon` WHERE `adminsalon`.`idSalon` = '.$idSalon;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

      try {
        $sql = 'DELETE FROM `stockageinfosalon` WHERE `stockageinfosalon`.`idSalon` = '.$idSalon;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }

      try {
        $sql = 'DELETE FROM `salon` WHERE `salon`.`idSalon` = '.$idSalon;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
  }
      
  function UpdateTitreSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `nomSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function UpdateImageSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `imageSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function UpdateDateDebutSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `dateDebutSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function UpdateDateFinSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `dateFinSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function UpdateHoraireDebutSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `ouvertureSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function UpdateHoraireFinSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `fermetureSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
  
  function UpdateLocalisationSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `villeSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function UpdateDescriptionSalon($nouveau)
  {
    include('db.php'); 
    try {
      $sql = 'UPDATE `salon` SET `descriptionSalon` = "'.$nouveau.'" WHERE `salon`.`idSalon` = "'.$_SESSION['idSalon'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
  // ------------------------- Fonction faite par Aymeric FIN ----------------------------

  // Affichage de la liste des salons
  function AfficheStand($idSalon)
  {
    include('db.php'); 
    try {
        $sql = $conn->prepare('SELECT * FROM `stand` WHERE `idSalon` = '.$idSalon);
        $sql->execute();
        $result = $sql->fetchAll();
        return json_encode($result);
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
  }

  function CheckAncienMdp($ancienMdp)
  {
    include('db.php'); 
    try {
        $sql = $conn->prepare('SELECT mdpUtilisateur FROM `utilisateur` WHERE `mailUtilisateur` = "'.$_SESSION['mail'].'"');
        $sql->execute();
        $result = $sql->fetchAll();
        foreach ($result as $user) {
          $mdpBase = $user['mdpUtilisateur'];
        }
        if (password_verify($ancienMdp, $mdpBase))
        {
          return true;
        }
        else
        {
          return false;
        }
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
  }

  function ChangerMdp($nouveauMdp)
  {
    include('db.php'); 
    $mdpCrypte = password_hash($nouveauMdp,PASSWORD_DEFAULT);
    try {
      $sql = 'UPDATE `utilisateur` SET `mdpUtilisateur` = "'.$mdpCrypte.'" WHERE `utilisateur`.`mailUtilisateur` = "'.$_SESSION['mail'].'";';
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
      return false;
    }
  }


?>