<?php
    $todos = [ ];

    function simpanData($daftar_todo){
            file_put_contents('todos.txt', serialize($daftar_todo));
            header('Location: index.php');
    };
    function ceklistData($ceklist){
        file_put_contents('todos.txt', serialize($ceklist));
        header('Location: index.php');
    }
    function hapusData($hapus){
        file_put_contents('todos.txt', serialize($hapus));
        header('Location: index.php');
    }

    if(file_exists('todos.txt')) {
        $file = file_get_contents('todos.txt');
        $todos = unserialize($file);
    }

    // cek apakah ada data yang dikirimkan melalui form
    if(isset($_POST['todo'])) {
        $data = $_POST['todo'];
        // tambahkan data ke array todos
        $todos[] = [
            'todo' =>$data,
            'status' => 0,
            ];
        simpanData($todos);
    }
    // cek get status
    if(isset($_GET['status'])) {
        $todos[$_GET['key']]['status'] = $_GET['status'];
        ceklistData($todos);
    }
    // cek get delete
    if(isset($_GET['hapus'])) {
        unset($todos[$_GET['key']]);
        hapusData($todos);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo App</title>
</head>
<body>
    <h1>My Todo App</h1>
    <!-- Form Input -->
    <form method="POST">
        <label>My To Do List</label>
        <input type="text" name="todo">
        <button type="submit">Simpan</button>
    </form>
    <!-- list todo -->
    <ul>
        <?php foreach($todos as $key => $value):?>
        <li>
            <input type="checkbox" name="todo" onclick="window.location.href='index.php?status= <?php echo ($value['status']==1)? '0':'1';?> &key=<?php echo $key;?>'"<?php if($value['status']==1) echo 'checked'; ?>>
            <label>
                <?php 
                if ($value['status'] == 1) {
                    echo '<del>'.$value['todo'].'</del>';
                } else {
                    echo $value['todo'];
                }
                ?>
            </label>
            <a href="index.php?hapus=1&key=<?php echo $key; ?>">Hapus</a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>