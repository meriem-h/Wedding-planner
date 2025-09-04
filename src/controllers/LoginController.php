<?php
class LoginController extends Controller {

    private $user;

    public function __construct($db)
    {
        $this->user = new User($db);
    }

   public function index($error = null)
    {

      session_start(); // s'assurer que la session est démarrée

          // Si l'utilisateur est déjà connecté, le rediriger vers /user/index ou home
          if (isset($_SESSION['user_id'])) {
               $this->redirect('/home/index'); // ou /home si tu as un HomeController
               return;
          }

        $this->render('login/index', ['error' => $error], false);
    }



    // Vérifie les identifiants
    public function authenticate()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            echo "Email et mot de passe requis";
            return;
        }

        $user = $this->user->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            $this->redirect('/user/index');
            exit;
        } else {
             $this->index("Identifiants incorrects");
        }
    }

    // Déconnexion
    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect('/login/index');
        exit;
    }


}