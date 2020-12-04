 <link rel="stylesheet" href="style.css">
   <table class="table">
    <thead>
        <th>first_name</th> 
        <th>last_name</th>
        <th>login</th>
        <th>img</th>
    </thead>
    <tbody>
        <?php            
             require_once('connection.php');

            $queryUser = "SELECT  first_name, last_name, login, img FROM users";
            $resultUser = mysqli_query($conn, $queryUser);

            if($resultUser){
                while($rowUser = mysqli_fetch_array($resultUser)){
                    echo "<tr>";
                        echo "<td>".$rowUser['first_name']."</td>";
                        echo "<td>".$rowUser['last_name']."</td>";
                        echo "<td>".$rowUser['login']."</td>";
                        echo "<td> <img src='public/images/".$rowUser['img']."' alt='' width='50' height='50'></td>";

                    echo "</tr>";
                }
            }
        ?>
    </tbody> 
</table>