<form action="form.php" method="POST">
    <label for="surname">Surname:</label><br>
    <input type="text" id="surname" name="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required><br><br>
    
    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>" required><br><br>
    
    <label for="phone">Phone:</label><br>
    <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required><br><br>
    
    <label for="website">Website:</label><br>
    <input type="url" id="website" name="website" value="<?php echo isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; ?>" required><br><br>
    
    <input type="submit" value="Submit">
</form>
