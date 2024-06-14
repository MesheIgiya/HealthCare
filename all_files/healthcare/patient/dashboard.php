<?php
    session_start();
    include '../scripts/connect_db.php';
    // Check if the user is logged in
    if (!isset($_SESSION['has_login'])) {
        header('Location: login.php');
        exit();
    }

    //get connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Define a SQL query to retrieve the tables from the database
    $patient_user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM bookings WHERE patient_user_id = '$patient_user_id'";
    $result = $conn->query($sql);

    $datas = array();

    while ($row = $result->fetch_row()) {
        $datas[] = $row;
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-cover bg-center relative" style="background-image: url('../bg.jpg');">
    <div class="absolute inset-0 bg-teal-700 opacity-80"></div>

    <button class="absolute top-3 right-3 z-10 bg-teal-500 hover:bg-teal-700 focus:bg-teal-700 text-white rounded-lg px-3 py-3 font-semibold" id="logout">Logout</button>
    <div class="relative min-w-screen min-h-screen flex items-center justify-center px-5 py-5" id="login">
      <div class="flex space-x-10">
        <div id="bookings" class="p-8 bg-white bg-opacity-80 rounded shadow-lg">
            <div class="relative overflow-x-auto">
                <h2 class="flex justify-center text-2xl font-bold text-teal-700 mb-4">Your Bookings</h2>
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
                                Doctor
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $data) : 
                                if($data[6] == 'APPROVED'){
                                    $color = 'text-green-500';
                                }
                                else if($data[6] == 'DISAPPROVED'){
                                    $color = 'text-red-600';
                                }
                                else{
                                    $color = 'text-orange-500';
                                }
                            ?>
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
                                <td class="px-6 py-4 font-bold <?php echo $color ?>">
                                    <?php echo $data[6] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $data[7] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>

        </div>
        <div id="book_now" class="p-8 bg-white bg-opacity-80 rounded shadow-lg w-80">
            <h2 class="text-2xl font-bold text-teal-700 mb-4">Book Now</h2>
            <form id="booking_form">
                <div class="mb-4">
                    <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="patient_firstname" name="patient_firstname" class="mt-1 block w-full p-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="patient_lastname" name="patient_lastname" class="mt-1 block w-full p-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="patient_address" name="patient_address" class="mt-1 block w-full p-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone No.</label>
                    <input type="text" id="patient_phone_no" name="patient_phone_no" class="mt-1 block w-full p-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" id="patient_booking_date" name="patient_booking_date" class="mt-1 block w-full p-2 border-gray-300 rounded-md">
                </div>
                <button type="submit" id="submit_appointment" class="w-full bg-teal-700 text-white py-2 px-4 rounded">Book Appointment</button>
            </form>
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
    <script src="../js/index.js"></script>
</body>
</html>
