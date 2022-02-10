<?php 
    include_once("AbstractDAO.php");
    include_once("models/entites/Utilisateur.php");
    class UtilisateurDAO extends AbstractDAO {
        // indiquer le nom de la table
        public function __construct() {
            parent::__construct('utilisateur');
        }
        // CREATE
        public function create ($result) {
            return new Utilisateur(
                !empty($result['id']) ? $result['id'] : 0,
                $result['login'],
                $result['role']
            );
        }
        public function deepCreate ($result) {
            if(!$result){
                return false;
            }
            // var_dump($result);
            return new Utilisateur(
                $result['id'],
                $result['login'],
                $result['role'],
                $result['mdp']                
            );
        }
        // INSERT
        public function store ($data) {
            if (empty($data['login']) || empty($data['mdp']) || empty($data['role']) ) {
                return false;
            }
            
            $utilisateur = $this->create(
                // htmlspecialchars() : retourne la donnée échapée
                [
                    'id' => htmlspecialchars($data['id']),
                    'login' => htmlspecialchars($data['login']),
                    'mdp' => htmlspecialchars($data['mdp']),
                    'role' => htmlspecialchars($data['role'])
                ]
            );
            
            if($utilisateur) {
                try {
                    $statement = $this->connection->prepare("INSERT INTO {$this->table} (login, mdp, role) VALUES (?)");
                    $statement->execute([
                        $utilisateur->login,
                        $utilisateur->mdp,
                        $utilisateur->role
                        
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
    
            $utilisateur = $this->create(
                [
                    'id'=> htmlspecialchars($id),
                    'nom' => htmlspecialchars($data['nom'])
                    
                ]
            );
    
            if($utilisateur) {
                try {
                    $statement = $this->connection->prepare("UPDATE {$this->table} SET login = ?, mdp = ?, role = ? WHERE id = ?");
                    $statement->execute([
                        $utilisateur->login,
                        $utilisateur->mdp,
                        $utilisateur->role,
                        $utilisateur->id
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

        // VERIFIER la connexion
        public function verify($login, $mdp){
            // TODO : mettre en place hash du mdp
            try {
                $statement = $this->connection->prepare("SELECT id, login, role FROM {$this->table} WHERE login = ? AND mdp = ?");
                $statement->execute(
                    [
                        $login,
                        $mdp
                    ]
                );
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                if(!$result){
                    return false;
                }
                
                return $this->create($result);
                
            } catch (PDOException $e) {
                var_dump($e);
            }
        }
    }
?>