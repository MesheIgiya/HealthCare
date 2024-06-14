<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['has_login_doctor'])) {
    header('Location: login.php');
    exit();
}

    include '../scripts/connect_db.php';

    //get connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Define a SQL query to retrieve the tables from the database

    $sql = "SELECT * FROM bookings WHERE status = 'PENDING'";
    $result = $conn->query($sql);

    $datas = array();

    while ($row = $result->fetch_row()) {
        $datas[] = $row;
    }

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center relative" style="background-image: url('../bg.jpg');">
    <div class="absolute inset-0 bg-teal-700 opacity-80"></div>
    
    <button class="absolute top-3 right-3 z-10 bg-teal-500 hover:bg-teal-700 focus:bg-teal-700 text-white rounded-lg m-3 px-3 py-3 font-semibold" id="logout">Logout</button>
    <div class="relative min-w-screen min-h-screen flex items-center justify-center px-5 py-5" id="login">
      <div class="flex space-x-10">
        <div id="bookings" class="p-8 bg-white bg-opacity-80 rounded shadow-lg">
            <div class="relative overflow-x-auto">
                <h2 class="flex justify-center text-2xl font-bold text-teal-700 mb-4">Bookings</h2>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-teal-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Patient Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $data) : ?>
                            <tr class="bg-white border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <?php echo $data[2] ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $data[4] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $data[3] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $data[5] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $data[6] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="bg-green-600 hover:bg-green-800 focus:bg-green-800 text-white rounded-lg px-3 py-3 font-semibold approve" value="<?php echo $data[0] ?>"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg></button>
                                    <button class="bg-red-500 hover:bg-red-700 focus:bg-red-700 text-white rounded-lg px-3 py-3 font-semibold disapprove" value="<?php echo $data[0] ?>"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>

        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.x.x.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="../js_doctor/index.js"></script>
</body>
</html>