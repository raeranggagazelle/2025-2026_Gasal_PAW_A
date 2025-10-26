<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; font-size: 14px; }
        input, select { width: 300px; padding: 5px; margin: 5px 0; }
        .submit-btn { padding: 8px 20px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        .submit-btn:hover { background: #45a049; }
    </style>
</head>
<body>
    <h2>Form Input Data Mahasiswa</h2>
    
    <?php
    $errors = array();
    $hasFormData = !empty($_POST);
    
    if ($hasFormData) {
        if (empty($_POST['nim'])) {
            $errors['nim'] = "NIM tidak boleh kosong";
        } else if (!preg_match("/^[0-9]{8,12}$/", $_POST['nim'])) {
            $errors['nim'] = "NIM harus berupa angka, 8-12 digit";
        }
        
        if (empty($_POST['nama'])) {
            $errors['nama'] = "Nama tidak boleh kosong";
        } else if (!preg_match("/^[a-zA-Z\s]{3,50}$/", $_POST['nama'])) {
            $errors['nama'] = "Nama hanya boleh huruf, minimal 3 karakter, maksimal 50 karakter";
        }
        
        if (empty($_POST['email'])) {
            $errors['email'] = "Email tidak boleh kosong";
        } else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST['email'])) {
            $errors['email'] = "Format email tidak valid";
        }
        
        if (empty($_POST['password'])) {
            $errors['password'] = "Password tidak boleh kosong";
        } else if (strlen($_POST['password']) < 8) {
            $errors['password'] = "Password minimal 8 karakter";
        } else if (!preg_match("/^[a-zA-Z0-9@#$%]+$/", $_POST['password'])) {
            $errors['password'] = "Password hanya boleh huruf, angka, dan karakter @#$%";
        }
        
        if (empty($_POST['semester'])) {
            $errors['semester'] = "Semester tidak boleh kosong";
        } else if (!preg_match("/^[1-8]$/", $_POST['semester'])) {
            $errors['semester'] = "Semester harus antara 1-8";
        }
        
        if (!empty($errors)) {
            echo '<div style="background: #ffebee; padding: 10px; border-left: 4px solid #f44336; margin-bottom: 20px;">';
            echo '<h3 style="color: #f44336; margin-top: 0;">Error: Input tidak valid!</h3>';
            foreach ($errors as $field => $error) {
                echo "<p class='error'>- " . ucfirst($field) . ": $error</p>";
            }
            echo '</div>';
        } else {
            echo '<div style="background: #e8f5e9; padding: 10px; border-left: 4px solid #4CAF50; margin-bottom: 20px;">';
            echo '<h3 style="color: #4CAF50; margin-top: 0;">✓ Form submitted successfully!</h3>';
            echo '<p><strong>Data yang berhasil disubmit:</strong></p>';
            echo '<ul>';
            echo '<li>NIM: ' . htmlspecialchars($_POST['nim']) . '</li>';
            echo '<li>Nama: ' . htmlspecialchars($_POST['nama']) . '</li>';
            echo '<li>Email: ' . htmlspecialchars($_POST['email']) . '</li>';
            echo '<li>Password: ' . str_repeat('*', strlen($_POST['password'])) . '</li>';
            echo '<li>Semester: ' . htmlspecialchars($_POST['semester']) . '</li>';
            echo '</ul>';
            echo '</div>';
        }
    }
    ?>
    
    <form method="POST">
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" 
               value="<?php echo isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : ''; ?>" 
               placeholder="Contoh: 12345678" required>
        <?php if (isset($errors['nim'])) echo '<div class="error">' . $errors['nim'] . '</div>'; ?><br>
        
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" 
               value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" 
               placeholder="Contoh: John Doe" required>
        <?php if (isset($errors['nama'])) echo '<div class="error">' . $errors['nama'] . '</div>'; ?><br>
        
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" 
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
               placeholder="Contoh: email@example.com" required>
        <?php if (isset($errors['email'])) echo '<div class="error">' . $errors['email'] . '</div>'; ?><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" 
               placeholder="Minimal 8 karakter" required>
        <?php if (isset($errors['password'])) echo '<div class="error">' . $errors['password'] . '</div>'; ?><br>
        
        <label for="semester">Semester:</label><br>
        <select id="semester" name="semester" required>
            <option value="">-- Pilih Semester --</option>
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <option value="<?php echo $i; ?>" 
                        <?php echo (isset($_POST['semester']) && $_POST['semester'] == $i) ? 'selected' : ''; ?>>
                    Semester <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        </select>
        <?php if (isset($errors['semester'])) echo '<div class="error">' . $errors['semester'] . '</div>'; ?><br><br>
        
        <input type="submit" value="Submit" class="submit-btn">
    </form>
</body>
</html>
