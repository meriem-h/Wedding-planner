<?php
class UserController  extends Controller {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    // Récupérer tous les users
    public function index()
    {
        $user = $this->user->getAll();

        // Appelle la vue et envoie $user
        $this->render('user/index', ['user' => $user]);
    }


    // Récupérer un user par ID
    public function show($id) {
        return $this->user->getById($id);
    }

  
    // Créer un user à partir d’une requête (formulaire POST)
    public function create() {
       
        $rawData = $_POST;

        // Recomposer l’array attendu
        $data = [
            "name" => $rawData['name'] ?? null,
            "email" => $rawData['email'] ?? null,
            "password" => isset($rawData['password']) ? password_hash($rawData['password'], PASSWORD_DEFAULT) : null,
            "role" => $rawData['role'] ?? 'user',
            "gender" => $rawData['gender'] ?? null,
        ];

        // pour les role a voir car a l'inscription c'est sois spouse soit planner et pour honorparty via un token ?

        return $this->user->add($data);;
    }

    // Mettre à jour un user
    public function update($id, array $data) {
        return $this->user->update($id, $data);
    }

    // Supprimer un user
    public function destroy($id) {
        return $this->user->delete($id);
    }
}