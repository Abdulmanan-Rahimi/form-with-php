<?php

$display_form = ($_SERVER['REQUEST_METHOD'] == 'GET')? true : false;

$errors = [];

if($display_form != true) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $comment = $_POST['comment'];
    $gender = isset($_POST['gender'])? $_POST['gender'] : '';
    $status = $_POST['status'];
    $law = isset($_POST['law'])? $_POST['law'] : '';

    
if($name == '') {
    $errors[] = 'Please enter your name';
} elseif (strlen($name) < 3) {
    $errors[] = 'Name should be at least 3 characters long';
}

if($email == '') {
    $errors[]  = 'Pleease enter your email address';
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address';
}

if($website == '') {
    $errors[]  = 'Pleease enter your website URL';
} elseif(!filter_var('http://' . $website, FILTER_VALIDATE_URL)) {
    $errors[] = 'Please enter a valid webvisite URL';
}

if($comment == '') {
    $errors[] = 'Please enter your comment';
} elseif (strlen($comment) < 3) {
    $errors[] = 'comment should be at least 10 characters long';
}

if(!in_array($status, ['important', 'medium', 'low']))  {
    $errors[] = 'Please select a status';

}


if(!in_array($gender, ['male', 'female'])) {
    $errors[] = 'gender is invalid';
}

if($law == '') {
    $errors[] = 'Please accept the conditions';
}



if(count($errors) > 0) {
    $display_form = true;
}


}
?>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php if ($display_form == true) :?>
    <main>
        <h2 class="center">Comment form</h2>
      <?php if(count($errors) > 0):  ?>
            <div id="error">
                <ul>
                    <?php foreach($errors as $error): ?> 
                    <li><span class="error"><?= $error ?></span></li> 
                    <?php endforeach ?>
                </ul>
            </div>
          <?php endif ?>
        <form method="post">
            <div class="form-control">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= isset($name)? $name : '' ?>">
            </div>
            <div class="form-control">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?= isset($email)? $email : '' ?>">
            </div>
            <div class="form-control">
                <label for="website">Website:</label>
                <input type="text" id="website" name="website" value="<?= isset($website)? $website : '' ?>">
            </div>
            <div class="form-control">
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" rows="5" cols="40"> <?= isset($comment)? $comment : '' ?></textarea>
            </div>
            <div class="form-control">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option>Please select status</option>
                    <option value="important" <?= (isset($status) and $status == 'important')? 'selected' : '' ?>>Important</option>
                    <option value="medium" <?= (isset($status) and $status == 'medium')? 'selected' : '' ?>>medium</option>
                    <option value="low" <?= (isset($status) and $status == 'low')? 'selected' : '' ?>>low</option>
                </select>
            </div>
            <div class="form-control">
                <label for="gender">Gender:</label>
                <input type="radio" name="gender" <?= (isset($gender) and $gender == 'female')? 'checked' : '' ?> value="female" > Female
                <input type="radio" name="gender" <?= (isset($gender) and $gender == 'male')? 'checked' : '' ?> value="male" > Male
            </div>
            <div class="form-control">
                <input type="checkbox" id="law" <?= (isset($law) and $law == 'law')? 'checked' : ''   ?> name="law" value="law" > I accept
            </div>
            <div class="form-control center">
                <input type="submit" value="submit">
            </div>
        </form>
    </main>
    
<?php else: ?>

    <section>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Gender</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $name ?></td>
                <td><?= $email ?></td>
                <td><?= $website ?></td>
                <td><?= $gender ?></td>
                <td><?= $status ?></td>
            </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="5"><?= $comment ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5"></td>
                </tr>
            </tbody>
        </table>
    </section>

<?php endif ?>

</body>
</html>