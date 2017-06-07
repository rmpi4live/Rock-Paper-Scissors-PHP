<?php
session_start();

include_once("includes/class.TemplatePower.inc.php");

$template = new TemplatePower("home.html");
$template -> prepare();

/*echo $_POST['verzenden'];

if(!isset($_POST["verzenden"])){
    $template->gotoBlock("_ROOT");
    $template->assign("TEST", "niet verzonden");
}else{
    $template->gotoBlock("_ROOT");
    $template->assign("TEST", "verzonden");
}

// test voor POST
if ( isset($_POST) ){
    var_dump( $_POST );

}
*/

if ( !isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if ( !isset($_SESSION['computer'])){
    $_SESSION['computer'] = 0;
}

if ( isset($_POST['reset'])){
    $_SESSION['score'] = 0;
    $_SESSION['computer'] = 0;
}

if ( isset($_POST['gebruiker_keuze']) ){

    $gebruiker_keuze = $_POST['gebruiker_keuze'];

    // echo "Gebruikerkeuze $gebruiker_keuze";
    // var_dump( $_POST );

    $keuze_uit = array("Rock", "Paper", "Scissors");

    $keuze = rand(0,2);

    $computer = $keuze_uit[$keuze];

    $template->newBlock("SCOREBOARD");
    //$template->assign("message",'It\'s a draw. -_-');

    //echo "You picked: " . "$gebruiker_keuze" . "<br>" ;
    //echo "Computer picked: " . "$computer" ;

    if($gebruiker_keuze == $computer){
        //echo "It's a draw. -_-'";
        $template->assign("message",'It\'s a draw. -_-');
        $_SESSION['score'] = (int)$_SESSION['score'];
    }
    elseif($gebruiker_keuze == 'Rock' and $computer == 'Scissors'){
        $template->assign("message","You won. :) ");
        //echo "You won. :)";
        $_SESSION['score'] = (int)$_SESSION['score'] +1 ;
        $_SESSION['computer'] = (int)$_SESSION['computer'] ;
    }
    elseif($gebruiker_keuze == 'Rock' and $computer == 'Paper'){
        $template->assign("message","You lost. :( ");
        //echo "You lost. :(";
        $_SESSION['score'] = (int)$_SESSION['score'];
        $_SESSION['computer'] = (int)$_SESSION['computer'] +1 ;
    }
    elseif($gebruiker_keuze == 'Paper' and $computer == 'Rock'){
        $template->assign("message","You won :) ");
        //echo "You won. :)";
        $_SESSION['score'] = (int)$_SESSION['score'] +1 ;
        $_SESSION['computer'] = (int)$_SESSION['computer'] ;
    }
    elseif($gebruiker_keuze == 'Paper' and $computer == 'Scissors'){
        $template->assign("message","You lost. :( ");
        //echo " You lost. :(";
        $_SESSION['score'] = (int)$_SESSION['score'];
        $_SESSION['computer'] = (int)$_SESSION['computer'] ;
    }
    elseif($gebruiker_keuze == 'Scissors' and $computer == 'Rock'){
        $template->assign("message","You lost. :( ");
        //echo "You lost. :(";
        $_SESSION['score'] = (int)$_SESSION['score'];
        $_SESSION['computer'] = (int)$_SESSION['computer'] +1 ;
    }
    elseif($gebruiker_keuze == 'Scissors' and $computer == 'Paper'){
        $template->assign("message","You won. :) ");
        //echo " You won. :)";
        $_SESSION['score'] = (int)$_SESSION['score'] +1;
        $_SESSION['computer'] = (int)$_SESSION['computer'] ;
    }

    $template->assign("SCORE", $_SESSION['score'] );
    $template->assign("keuze", $gebruiker_keuze );
    $template->assign("comp", $computer );
    $template->assign("computerscore", $_SESSION['computer'] );


    //echo "Your score is: " . $_SESSION['score'];

}


$template->printToScreen();

?>