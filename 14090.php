<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Responsi IAI 2019</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>
    <?php
    $curl = curl_init();

    @$key = $_GET['results'];
    if($key == '') {
        $jumlah = 1;
    }else{
        $jumlah = $key;
    }

    @$key2 = $_GET['gender'];
    if($key2 == ''){
        $jenisKelamin = '';
    }else{
        if($key2 == 'male'){
            $jenisKelamin = 'male';
        }else{
            $jenisKelamin = 'female';
        }
    }

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://randomuser.me/api/?results=$jumlah&gender=$jenisKelamin",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if($err){
        echo "CURL ERROR #:" .$err; 
    }else{
        $response = json_decode($response);

        $users = $response->results;
    }
    ?>
    <div class="container">
        <table class="table table-hover table-bordered" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            
            <tbody>
            <?php $i=1; foreach($users as $user) : ?>
            <tr>
                <td><?=$i++?></td>
                <td><img src="<?=$user->picture->large?>"></td>
                <td><?=$user->name->first?><?=$user->name->last?></td>
                <td><?=$user->location->street?><?=$user->location->city?></td>
                <td><?=$user->email?></td>
            </tr>
            <?php endforeach?>
            </tbody>
        </table>
    </div>
</body>
</html>