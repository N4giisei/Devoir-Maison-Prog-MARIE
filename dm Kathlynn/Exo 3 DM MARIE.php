<?php

// Interface définissant la méthode sePresenter
interface PresentationInterface {
    public function sePresenter();
}

// Classe de base Personne avec les attributs Prenom et Age
class Personne {
    protected $prenom;
    protected $age;

    public function __construct($prenom, $age) {
        $this->prenom = $prenom;
        $this->age = $age;
    }
}

// Classe Homme héritant de Personne et implémentant l'interface
class Homme extends Personne implements PresentationInterface {
    // Implémentation de la méthode sePresenter
    public function sePresenter() {
        echo "Je suis un Homme de {$this->age} ans et je m'appelle {$this->prenom}\n";
    }
}

// Classe Femme héritant de Personne et implémentant l'interface
class Femme extends Personne implements PresentationInterface {
    // Implémentation de la méthode sePresenter
    public function sePresenter() {
        echo "Je suis une Femme de {$this->age} ans et je m'appelle {$this->prenom}\n";
    }
}

// Exemple
$homme = new Homme("John", 30);
$femme = new Femme("Jane", 25);

$homme->sePresenter();
$femme->sePresenter();

?>
