<?php 
    include_once("AbstractDAO.php");
    include_once("models/entites/Reservation.php");
    
    class ReservationDAO extends AbstractDAO {
        
        // indiquer le nom de la table
        public function __construct() {
            parent::__construct('reservation');
        }

        public function foodtruck($idFoodTruck){
            return $this->belongsTo(new FoodtruckDAO(), $idFoodTruck);
        }


        // CREATE
        public function create ($result) {
            return new Reservation(
                !empty($result['id']) ? $result['id'] : 0,
                $result['date'],
                $result['statut'],
                $result['fk_foodtruck']       
            );
        }
        public function deepCreate ($result) {
            if(!$result){
                return false;
            }
            // var_dump($result);
            return new Reservation(
                $result['id'],
                $result['date'],
                $result['fk_statut'],
                $this->foodtruck($result['fk_foodtruck'])  
            );
        }
        // INSERT
        public function store ($data) {
            if (empty($data['date']) || empty($data['statut']) || empty($data['fk_foodtruck'])) {
                return false;
            }
            
            $reservation = $this->create(
                // htmlspecialchars() : retourne la donnée échapée
                [
                    'id' => htmlspecialchars($data['id']),
                    'date' => htmlspecialchars($data['date']),
                    'fk_statut' => htmlspecialchars($data['statut']),
                    'fk_foodtruck' => htmlspecialchars($data['fk_foodtruck'])
                ]
            );
            
            if($reservation) {
                try {
                    $statement = $this->connection->prepare("INSERT INTO {$this->table} (date, fk_statut, fk_foodtruck) VALUES (?, ?, ?)");
                    $statement->execute([
                        $reservation->date,
                        $reservation->statut,
                        $reservation->foodtruck
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
    
            if (empty($data['date']) || empty($data['statut']) || empty($data['fk_foodtruck'])) {
                return false;
            }
    
            $reservation = $this->create(
                [
                    'id'=> htmlspecialchars($id),
                    'date' => htmlspecialchars($data['date']),
                    'statut' => htmlspecialchars($data['statut']),
                    'fk_foodtruck' => htmlspecialchars($data['fk_foodtruck']),
                ]
            );
    
            if($reservation) {
                try {
                    $statement = $this->connection->prepare("UPDATE {$this->table} SET date = ?, fk_statut = ?, fk_foodtruck = ? WHERE id = ?");
                    $statement->execute([
                        $reservation->date,
                        $reservation->statut,
                        $reservation->foodtruck,
                        $reservation->id
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