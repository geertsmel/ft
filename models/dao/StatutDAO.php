<?php 
    include_once("AbstractDAO.php");
    include_once("models/entites/Statut.php");
    class StatutDAO extends AbstractDAO {
        // indiquer le nom de la table
        public function __construct() {
            parent::__construct('statut');
        }
        // CREATE
        public function create ($result) {
            return new Statut(
                !empty($result['id']) ? $result['id'] : 0,
                $result['nom']   
            );
        }
        public function deepCreate ($result) {
            if(!$result){
                return false;
            }
            // var_dump($result);
            return new Statut(
                $result['id'],
                $result['nom']
            );
        }
        // INSERT
        public function store ($data) {
            if (empty($data['nom'])) {
                return false;
            }
            
            $statut = $this->create(
                // htmlspecialchars() : retourne la donnée échapée
                [
                    'id' => htmlspecialchars($data['id']),
                    'nom' => htmlspecialchars($data['nom'])
                    
                ]
            );
            
            if($statut) {
                try {
                    $statement = $this->connection->prepare("INSERT INTO {$this->table} (nom) VALUES (?)");
                    $statement->execute([
                        $statut->nom
                        
                    ]);
                    return true;
                } catch (PDOException $e) {
                    $this->message_error($e);
                    return false;
                }
            }
        }
        // UPDATE
        public function update ($id, $data) {
    
            if (empty($data['nom'])) {
                return false;
            }
    
            $statut = $this->create(
                [
                    'id'=> htmlspecialchars($id),
                    'nom' => htmlspecialchars($data['nom'])
                    
                ]
            );
    
            if($statut) {
                try {
                    $statement = $this->connection->prepare("UPDATE {$this->table} SET nom = ? WHERE id = ?");
                    $statement->execute([
                        $statut->nom,
                        $statut->id
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
            } catch(PDOException $e) {
               $this->message_error($e);
            }
        }
    }
?>