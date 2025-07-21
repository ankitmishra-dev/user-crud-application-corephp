<!DOCTYPE html>
<html>
<head>
    <title>User CRUD Operations</title>
</head>
<body>
    <h2>Create User</h2>
    <form method="POST" action="routes\api.php?action=create">
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="date" name="dob" required><br><br>
        <button type="submit">Create User</button>
    </form>

    <hr>

    <h2>Read Users</h2>
    <form method="GET" action="routes\api.php">
        <input type="hidden" name="action" value="read">
        <button type="submit">Show All Users</button>
    </form>

    <hr>

    <h2>Update User</h2>
    <form method="POST" action="routes\api.php?action=update">
        <input type="number" name="id" placeholder="User ID" required><br><br>
        <input type="text" name="name" placeholder="New Name" required><br><br>
        <input type="email" name="email" placeholder="New Email" required><br><br>
        <input type="date" name="dob" required><br><br>
        <button type="submit">Update User</button>
    </form>

    <hr>

    <h2>Delete User</h2>
    <form method="POST" action="routes\api.php?action=delete">
        <input type="number" name="id" placeholder="User ID to Delete" required><br><br>
        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
    </form>
</body>
</html>
