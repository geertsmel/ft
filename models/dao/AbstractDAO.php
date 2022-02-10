<?php 
    abstract class AbstractDAO {
        // infos de connexion à db
        protected $connection;
        // nom de la table où se situe l'infos
        protected $table;
        
        // est appelé  : = new AbstractDAO (mais pas vraiment puisque abstraite)
        // param : nom de la table
        public function __construct ($table) {
            // met à jour la protected $table avec $table
            $this->table = $table;
            // créer une connexion avec la base de données
            // PDO = Objet natif qui permet d'accéder à la DB de manière sécurisée
            // SGBD:
            //où=hébergé localement;
            //nomDB;
            // encodage de caractère est uft8
            // login de la base de données
            // mdp de la base de données windows => ''
            $this->connection = new PDO('mysql:host=localhost;dbname=foodtruck;charset=utf8', 'root', 'root');
            // permet afficher les exceptions(erreurs) liées à la base de données
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        // créer avec des relations
        //Créer tous avec relations
        public function createAllDeep ($results, $secure = false) {
            $list = array();
            foreach ($results as $result) {
                if($secure){
                    array_push($list, $this->createSecure($result));
                }
                else{
                    array_push($list, $this->deepCreate($result));
                }
                
            }
            return $list;
        }

        

        //chercher tous
        // READ
        public function fetchAll ($secure = false) {
            // essaie
            try {
                // prépare la requete : permet d'éviter les injections SQL
                $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
                // exécuter
                $statement->execute();
                // permet de récupérer les données au format clé => valeur
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                // permet de récupérer les infos en profondeur

                return $this->createAllDeep($result, $secure);
            } 
            // récupère l'erreur qui de type PDO
            catch (PDOException $e) {
                // affiche le message d'erreur
                print $e->getMessage();
            }
        }
        //chercher 1
        // READ
        public function fetch($id, $deep = true) {
            try {
                $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
                $statement->execute([$id]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                
                if($deep) {
                    return $this->deepCreate($result); 
                }
                return $this->create($result);
                
            } catch (PDOException $e) {
                var_dump($e);
            }
        }
        // READ where
        public function fetchWhere ($ref, $value, $secure = false) {
            try {
                $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$ref} = ?");
                $statement->execute([$value]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                return $this->createAllDeep($result, $secure);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }


        protected function message_error($error){
        
            $tab = [
                1451 => "Vous ne pouvez pas le supprimer car", 
                1062 => "Vous ne pouvez pas l'ajouter car"
            ];
    
            $code = $error->errorInfo[1];
            // var_dump($code);
    
            $message = "";
            // var_dump($message);
        
            switch($code) {
                case 1451: 
                    $msg = explode('`', $error->getMessage());
                    $what = $msg[9];
                    $where = $msg[3];
                    $message = $tab[$code] . " votre <b>$what</b> existe dans  <b>$where</b>";
                    break;
                case 1062: 
                    $msg = explode("'", $error->getMessage());
                    $what = $msg[3];
                    $message = $tab[$code] . " votre <b>$what</b> existe déjà";
                    break;
            }
            $_SESSION["message"]= '<div class="alert alert-danger mt-3" role="alert">' . $message. '</div>';
        }

        // ======= relation =====
        public function belongsTo ($dao, $id) {
            return $dao->fetch($id, false);
        }
        public function hasMany ($dao, $col, $key) {
            return $dao->fetchWhere($col, $key);
        }


    }
?>