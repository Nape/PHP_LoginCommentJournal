<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-05-01
 * Time: 6:23 PM
 */
class ConnectionBD
{
    private $BD;
    const Vieux = ' ORDER BY UNIX_TIMESTAMP(COMDATE) ASC';
    const Nouveau = ' ORDER BY UNIX_TIMESTAMP(COMDATE) DESC';

    public function __construct()
    {
        if ($this->BD == NULL)
        {
            try
            {
                $this->BD = new PDO('mysql:host=localhost:8889;dbname=tp3a18', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $exception)
            {
                die('Erreur: ' . $exception->getMessage());
            }
        }
        return $this->BD;
    }

    public function deconnectionBD()
    {
        $this->BD = NULL;
    }
    /**
     * Recherche un utilisateur et le retourne s'il est trouvé
     * @param $nomUtilisateur   Utilisateur présumé.
     * @return $utilisateur     Un utilisateur.
     * @throws Exception
     */
    public function getUtilisateur($nomUtilisateur,$mdp)
    {
        $existe = false;
        $requete = $this->BD->prepare('SELECT NOM, MOTPASSE FROM UTILISATEUR WHERE NOM = :NOM AND :MOTPASSE');
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $mdp = $this->cryptageMdp($mdp);
        $requete->execute(
            array(
                'NOM' => $nomUtilisateur,
                'MOTPASSE' => $mdp )
        );
        $resultat = $requete->fetch();
        $requete->closeCursor();
        if ($resultat['NOM'] == $nomUtilisateur && $resultat['MOTPASSE'] == $mdp)
        {
            $existe = true;
        }


//        if($resultat['NOM'] == $nomUtilisateur)
//        {
//            $existe = true;
//        }

        return $existe;
    }
    public function utisateurExiste($nomUtilisateur)
    {
        $existe = false;
        $requete = $this->BD->prepare('SELECT NOM FROM UTILISATEUR WHERE NOM = :NOM');
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $requete->execute(
            array(
                'NOM' => $nomUtilisateur
            )
        );
        $resultat = $requete->fetch();
        $requete->closeCursor();
        if ($resultat['NOM'] == $nomUtilisateur)
        {
            $existe = true;
        }

        return $existe;

    }

    /**
     * Ajoute un utilisateur dans la base de donnée.
     * @param $nom  Le nom d'utilisateur.
     * @param $mdp  Le mot de passe utilisateur.
     * @return bool
     */
    public function setUtilisateur($nom, $mdp)
    {   $ok = false;
        try
        {
            $mdp = $this->cryptageMdp($mdp);
            $ajout = $this->BD->prepare('INSERT INTO UTILISATEUR (NOM, MOTPASSE) VALUE (:NOM,:MOTPASSE)');
            $ajout->execute(array('NOM' => $nom, 'MOTPASSE' => $mdp));
            $ok = true;
        }
        catch (Exception $exception)
        {
            $exception->getMessage();
            return $ok;
        }
        return $ok;
    }

    private function getUtilisateurID($nomUtilisateur)
    {

        $requete = $this->BD->prepare('SELECT ID FROM UTILISATEUR WHERE NOM = :NOM');
        $requete->execute(array('NOM' => $nomUtilisateur));

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $resultat;
    }

    /**
     * Encrypte et Salt le mot de passe et le retourne.
     * @param  $aCrypter  Le texte en clair.
     * @return string    Mot de passe encrypté.
     */
    private function cryptageMdp($aCrypter)
    {
        $salted = "%.!%*f9u3b6Dx.|B83".$aCrypter."8h:.25;8_f!795+~3^9-6U";

        $hashed = hash('sha512',$salted);

        return $hashed;

    }

    //==============================================PARTIE COMMENTAIRES=========================================================

    public function setCommentaire($nomUtilisateur,$date,$commentaires)
    {
        $userID = $this->getUtilisateurID($nomUtilisateur);

        if (!$this->comparerCommentaires($nomUtilisateur,array('USERID'=> $userID['ID'],'DATE'=> $date, 'COMM' => $commentaires)))
        {

            if (!empty($userID['ID']) && !empty($date) != null && !empty($commentaires))
            {

                $commentaires = htmlspecialchars($commentaires);
                $ok = false;
                try
                {
                    $ajout = $this->BD->prepare('INSERT INTO COMMENTAIRES (USERID, COMDATE,COMMENTAIRE) VALUE (:userID,:comDate,:commentaire)');

                    $ajout->execute(array('userID' => $userID['ID'],
                        'comDate' => $date,
                        'commentaire' => $commentaires
                    ));
                    $ok = true;
                } catch (Exception $exception)
                {
                    $exception->getMessage();
                }
                return $ok;

            }
        }

    }

    public function getCommentaires($nomUtilisateur,$ordre)
    {
        $stm = "SELECT COMDATE, COMMENTAIRE, COMID, USERID FROM COMMENTAIRES WHERE USERID = (SELECT ID FROM UTILISATEUR WHERE NOM = :NOM)".$ordre;

        $requete = $this->BD->prepare($stm);
        $requete->execute(array('NOM' => $nomUtilisateur));
        $commentaires = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $commentaires;

    }

    public function suprimerCommentaire($nomUtilisateur,$comid)
    {
        $supprimer = false;
        try
        {
            $stm = "DELETE FROM COMMENTAIRES WHERE USERID = (SELECT ID FROM UTILISATEUR WHERE NOM = :NOM) AND COMID = :COMID";

            $requete = $this->BD->prepare($stm);
            $requete->execute(array('NOM'=> $nomUtilisateur,'COMID'=>$comid));
            $supprimer = true;
            $requete->closeCursor();
        }
        catch (Exception $exception)
        {
            $exception->getMessage();
        }
        return $supprimer;
    }

    private function comparerCommentaires($nomUtilisateur,$toCompare)
    {   $egaux = false;

        $commentaires = $this->getCommentaires($nomUtilisateur,$this::Nouveau);

        foreach ($commentaires as $commentaire)
        {
            if ($commentaire['USERID'] === $toCompare['USERID'] && $commentaire['COMDATE'] === $toCompare['DATE'] )
            {
                $egaux = true;
            }
        }

        return $egaux;
    }

}






