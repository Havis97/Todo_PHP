<?php
 $todos = [ ];

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
            $daftar_todo = serialize($todos);
            file_put_contents('todos.txt', $daftar_todo);
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
            <input type="checkbox" name="todo">
            <label><?php echo $value['todo']; ?></label>
            <a href="#">Hapus</a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>