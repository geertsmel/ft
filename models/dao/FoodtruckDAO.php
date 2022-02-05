<?php 
    include_once("AbstractDAO.php");
    include_once("models/entites/Foodtruck.php");
    class FoodtruckDAO extends AbstractDAO {
        // indiquer le nom de la table
        public function __construct() {
            parent::__construct('foodtruck');
        }
        // CREATE
        public function create ($result) {
            return new Foodtruck(
                !empty($result['id']) ? $result['id'] : 0,
                $result['nom'],
                $result['siteweb'],
                $result['fk_utilisateur']       
            );
        }
        public function deepCreate ($result) {
            if(!$result){
                return false;
            }
            // var_dump($result);
            return new Foodtruck(
                $result['id'],
                $result['nom'],
                $result['siteweb'],
                $result['fk_utilisateur']  
            );
        }
        // INSERT
        public function store ($data) {
            
            if (empty($data['nom']) || empty($data['siteweb']) || empty($data['fk_utilisateur'])) {
                return false;
            }
            
            $foodtruck = $this->create(
                // htmlspecialchars() : retourne la donnée échapée
                [
                    'nom' => htmlspecialchars($data['nom']),
                    'siteweb' => htmlspecialchars($data['siteweb']),
                    'fk_utilisateur' => htmlspecialchars($data['fk_utilisateur'])
                ]
            );
            
            if($foodtruck) {
                try {
                    $statement = $this->connection->prepare("INSERT INTO {$this->table} (nom, siteweb, fk_utilisateur) VALUES (?, ?, ?)");
                    $statement->execute([
                        $foodtruck->nom,
                        $foodtruck->siteweb,
                        $foodtruck->utilisateur
                    ]);
                    return true;
                } catch (PDOException $e) {
                    $this->message_error($e);
                    var_dump($e);
                    die;
                    return false;
                }
            }
        }
        // UPDATE
        public function update ($id, $data) {
    
            if (empty($data['nom']) || empty($data['siteweb']) || empty($data['fk_utilisateur'])) {
                return false;
            }
    
            $foodtruck = $this->create(
                [
                    'id'=> htmlspecialchars($id),
                    'nom' => htmlspecialchars($data['nom']),
                    'siteweb' => htmlspecialchars($data['siteweb']),
                    'fk_utilisateur' => htmlspecialchars($data['fk_utilisateur']),
                ]
            );
    
            if($foodtruck) {
                try {
                    $statement = $this->connection->prepare("UPDATE {$this->table} SET nom = ?, siteweb = ?, fk_utilisateur = ? WHERE id = ?");
                    $statement->execute([
                        $foodtruck->nom,
                        $foodtruck->siteweb,
                        $foodtruck->utilisateur,
                        $foodtruck->id
                    ]);
                    return true;
                } catch (PDOException $e) {
                    $this->message_error($e);
                    return false;
                }
            }
        }
        // DELETE
        function delete ($data) {
            if(empty($data['id'])) {
                return false;
            }
           
            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = ?");
                $statement->execute([
                    $data['id']
                ]);
                return true;
            } catch(PDOException $e) {
               $this->message_error($e);
               return false;
            }
        }
    }
?>