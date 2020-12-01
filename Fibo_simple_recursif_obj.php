<!DOCTYPE html>
<!--
    Affiche un formulaire, permet l'entrée d'un nombre et affiche la suite de Fibonacci correspondante
    Méthode de calcul récursive
    Modèle objet
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
        h1 {
          font-family: arial, sans-serif;
        }
        h2 {
          font-family: arial, sans-serif;
        }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
    </head>
    <body>
        <h1>Serie de Fibonacci</h1>
        <h2>Calcul récursif</h2>
        
        <table style="width:100%">
        <tr>
          <th>Données d'entrée</th>
          <th>Résultats</th>
        </tr>
        <tr>
            <td>
                <!--
                    Affiche le formulaire
                -->
				<small>Attention :</br>Au delà de 40 éléments, le calcul récursif devient très long, et peut même provoquer une erreur (timeout)</small></br></br>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label>Nombre d'éléments :</label><input type="text" name="rang_fibo" id="number"/><br><br>
                <input name="form" type="submit" value="Calculer"/>
                </form>
            </td>
            <td>
                <?php
					//
					// Fonction de Fibonacci, utilisée de manière récursive
					//
					class Fibo
					{
						// Vérifie si le formulaire a été 'soumis'
						// Si oui, récupère le nombre entré par l'utilisateur, et affiche la suite de Fibonacci correspondante
						public function Initialize ()
						{
							$index = -1;             // jusqu'à quel rang voulons calculer la suite de Fibonacci ?
							if ($_SERVER["REQUEST_METHOD"]=="POST")
							{
								$index= $_POST['rang_fibo'];
								if (is_numeric($index))
								{
									if ($index>0)
										$index = intval ($index);
									else
										$index = -1;    // Retourne code d'erreur
								}
								else
									$index=-1;       // Retourne code d'erreur
							}
							return $index;
						}

						// Fonction de Fibonacci, utilisée de manière recursive
						public function Compute($index)
						{
							if ($index == 0)
								return 0;
							else if ($index == 1)
								return 1;
							return ($this->Compute ($index-1) + $this->Compute ($index -2));
						}
					}
					
					// Flux principal
					$Fibonacci = new Fibo ();                           // Crée instance de l'objet Fibo
					$rank = $Fibonacci->Initialize ();                  // Cherche l'entrée utilisateur et la valide
					if ($rank>0)                                        // Si entrée ok :
					{													// Calcule et affiche la suite de Fibonacci jusqu'au rang $rank
						echo '0';
						for($counter = 1; $counter < $rank; $counter++)
							echo ', '.$Fibonacci->Compute($counter);
					}
					else                                                // Sinon
						echo 'Veuillez svp entrer un nombre positif, plus grand que zéro';   // Affiche message d'erreur
				?>
            </td>
        </tr>
      </table>
    </body>
</html>
