<?php
//Start a new session
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']) {
    require_once('../class/db.class.php');
    require_once('../class/production.class.php');
    // get app config
    $dbConfig = include '../config/db_config.php';
    //connection to database
    $db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
    //inset introduction by id with distribution and production dates
    $prds = new Production($db);
    $prodList = $prds->getByIdWithDistAndDates($_POST['idProd']);
    // descrut connection
    //liberate memory space
    $db->close();

    $_SESSION['selectedProd'] = true;

    $min_date = '';
    $max_date = '';
    $rep = '';

    if (count($prodList['dates']) > 0) {
        //sort dates array
        array_multisort(array_column($prodList['dates'], "dateHeure"), SORT_ASC, $prodList['dates']);
        $min_date = date("j M Y", strtotime($prodList['dates'][0]['dateHeure']));
        $max_date = date("j M Y", strtotime($prodList['dates'][count($prodList['dates'])-1]['dateHeure']));

        foreach ($prodList['dates'] as $date) {
            $dt = date("j M Y à H:i", strtotime($date['dateHeure']));
            $rep .= '<span style="display:block">' . $dt .'</span>';
        }
    }

    $html = '
        <div class="infos">
            <h3>'.$prodList['intitule'].'</h3>
            <h5>'.$prodList['compositeur'].'</h5>
            ';
    if (!empty($min_date) && !empty($max_date)) {
        $html .= '<span style="color:#ccc"> Du '. $min_date .' au '. $max_date .'</span>';
    }
    $html .= '
        </div>
        <div class="rep">
            <h4> Représentations</h4>
            '.$rep.'
        </div>
        <div class="dist">
            <h4> Distributions</h4>
            <button type="button" class="btn" style="float:right" onclick="showForm()"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
            <form id="distForm" action="scripts/distributions.php" method="POST" style="display:none">
                <input type="hidden" class="form-control form-control-lg" name="idProd" value="'.$prodList['id'].'" />
                <input type="text" class="form-control form-control-lg" name="role" placeholder="Role" />
                <input type="text" class="form-control form-control-lg" name="artiste" placeholder="Artiste" />
                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Créer</button>
            </form>
            ';
    if (count($prodList['distributions']) > 0) {
        $html .= '
            <table class="dist-table table">
                <thead>
                    <tr>
                    <th scope="col">Rôle</th>
                    <th scope="col">Artiste</th>
                    </tr>
                </thead>
                <tbody>
                    ';
        foreach ($prodList['distributions'] as $dist) {
            $html .= '<tr>
                        <td>'.$dist['role'].'</td>
                        <td>'.$dist['artiste'].'</td>
                    </tr>';
        }
                    
        $html .= '
                </tbody>
            </table>
        ';
    }

    $html .= '</div>';
    echo $html;
}
